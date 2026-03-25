<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use Str;
use App\Models\AdminToken;
use DB;
use App\Models\Admin;
use App\Models\User;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $apiUrl = 'https://nanoclub.ir/api/v3/authorize-admin';

        $response = Http::post($apiUrl, [
            'username' => $request->username
        ]);

        if ($response->successful() && $response->json('success')) {
            $adminData = $response->json('data');
            $token = $adminData['token'];
            $email = $adminData['email'];

            return redirect('/admin/verify')->withSuccess('2fa Verification Code Sent Successfully...')->with('admin_token', $token)->with('admin_email', $email);
        }

        return back()->withErrors(['username' => 'Login failed or invalid credentials.']);
    }

    public function showVerify()
    {
        session()->reflash();

        $adminToken = Session::get('admin_token');
        $email = Session::get('admin_email');

        Session::put('admin_token',$adminToken);
        Session::put('admin_email',$email);

        if(!$adminToken){
            return redirect('/admin/login')->withErrors('Token not found!');
        }

        return view('admin.login.verify', compact('email'));
    }

    public function doVerify(Request $request)
    {
        $request->session()->reflash();
        $request->validate([
            'token' => 'required',
        ]);
        $apiUrl = 'https://nanoclub.ir/api/v3/verify-admin-2fa';

        $response = Http::post($apiUrl, [
            'token' => $request->token
        ]);

        if ($response->successful() && $response->json('success')) {
            $adminData = $response->json('data');
            $token = $adminData['token'];

            $admin = Admin::updateOrCreate(
                ['id' => $adminData['id']],
                [
                    'username' => $adminData['username'],
                    'name' => $adminData['name'],
                    'email' => $adminData['username'] . '@nanoclub.local',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'last_login_at' => now(),
                    'is_active' => true,
                ]
            );

            DB::table('admin_tokens')->where('admin_id', $admin->id)->delete();

            DB::table('admin_tokens')->insert([
                'admin_id' => $admin->id,
                'token' => $token,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            session()->put('admin', [
                'id' => $admin->id,
                'username' => $admin->username,
                'token' => $token,
            ]);

            return redirect()->route('adm.panel.index')->withSuccess('Welcome back super user.');
        }

        return back()->withErrors(['token' => 'Wrong Verification Code']);
    }
}
