<?php

namespace App\Http\Controllers\Etc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
class SubscribeController extends Controller
{
    public function newSubcribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $existingSubscriber = DB::table('subscriptions')->where('email', $request->input('email'))->first();

        if ($existingSubscriber) {
            Alert::error('Error', 'This email is already subscribed!');
            return back();
        }

        DB::table('subscriptions')->insert([
            'email' => $request->input('email')
        ]);

        Alert::success('Success', 'Subscriber added successfully!');

        return back();
    }
}
