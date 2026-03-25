<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Representative;
use Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Log;
use App\Http\Controllers\Etc\ToolsController;
class RepresentativeController extends ToolsController
{
    public function newRep(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required',
            'phone' => 'required',
            'passport_number' => 'required',
            'address' => 'required|string',
            'linkedIn' => 'nullable|url',
            'passportImage' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'captcha' => 'required|same:captcha'
        ];

        if (!auth()->check()) {
            $rules = array_merge($rules, [
                'email' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Alert::error('Validation Error', 'Please correct the errors in the form.');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('openRepForm', true);
        }

        try {
            $passportImagePath = null;
            if ($request->hasFile('passportImage')) {
                $passportImage = $request->file('passportImage');
                $fileName = time() . '-' . $passportImage->getClientOriginalName();
                $filePath = 'representatives/' . uniqid();
                $passportImagePath = $passportImage->storeAs($filePath, $fileName);
            }

            $user = User::where('email', $request->email)->first();
            if ($user) {
                Alert::error('Validation Error', 'User with this email already exists!');
                $validator->errors()->add('email', 'User with this email already exists! Try another one or login to your account.');

                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('openRepForm', true);
            }

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $countryCode = $request->input('country');
            $nationality = $this->getCountryNationality($countryCode);

            $representative = Representative::create([
                'user_id' => $user->id,
                'mobile' => $request->mobile,
                'phone' => $request->input('phone'),
                'address' => $request->address,
                'passport_number' => $request->passport_number,
                'linked_in' => $request->linked_in,
                'passport_image' => $passportImagePath,
                'nationality' => $nationality,
            ]);

            Alert::success('Success', 'User created successfully');
            Session::flash('success', 'Representative info saved successfully');
            Session::put('newRepAdded', $representative->email);
            session()->forget('captcha');
            session()->forget('openRepForm');

            return redirect()->back();
        } catch (\Exception $e) {
            Log::channel('rep')->error('Error occurred while creating representative: ' . $e->getMessage());

            Alert::error('Error', 'An unexpected error occurred. Please try again.');
            return redirect()
                ->back()
                ->withInput()
                ->with('openRepForm', true);
        }
    }
}
