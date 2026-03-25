<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactBox;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Mail;
use App\Mail\ContactMail;

class ContactBoxController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'g-recaptcha-response' => 'required'
        ]);

        $cacheKey = 'contact_message_' . $request->ip();
        if (Cache::has($cacheKey)) {
            Alert::error('Error', 'You are sending messages too quickly. Please wait a moment before trying again.');
            return redirect()->back();
        }

        try {
            $contact = ContactBox::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);

            if ($request->hasFile('attachment')) {
                $filePath = $request->file('attachment')->store("uploads/contacts/{$contact->id}/", 'public');
                $contact->update(['attachment' => $filePath]);
            }

            Mail::to(env('MNG_MAIL'))->send(new ContactMail($contact, $filePath));

            Cache::put($cacheKey, true, now()->addMinutes(1));

            Session::flash('messageSent', 'We will contact you soon.');
            Alert::success('Success', 'Message sent successfully!');
        } catch (\Exception $e) {
            Session::flash('messageNotSent', 'Something went wrong! Please try again.');
            Alert::error('Error', 'Something went wrong! Please try again.');
        }

        return redirect()->back();
    }
}
