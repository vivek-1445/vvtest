<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use App\Mail\PasswordResetLink;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class Controller extends BaseController
{
    public function login(Request $request)
    {
        $data['title'] = __('Login');
        return view('unauthorized.login', $data);
    }

    /**
     * authenticate user by Auth
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect(route('dashboard'));
        } else {
            toastr()->error(__('Bad Credentials!'));
            return redirect()->intended('login')->with($credentials);
        }
    }

    /**
     * Logout
     */
    public function logoutUser(Request $request)
    {
        Auth::logout();
        toastr()->success(__('Logged Out Successfully'));
        return redirect(route('login'));
    }

    public function forgotPasswordView(Request $request){
        $data['title'] = __('Forgot Password');
        return view('unauthorized.forgot-password', $data);
    }

    public function forgotPasswordPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::to($request->email)->send(new PasswordResetLink($token));
        toastr()->success(__('Passowrd reset instruction has been sent over email!'));
        return redirect(route('login'));

    }

    public function resetPassword(Request $request, $token){
        $data['title'] = __('Password Reset');
        $data['token'] = $token;
        return view('unauthorized.password-reset', $data);
    }

    public function resetPasswordPost(Request $request){
        
        $request->validate([
            'password' => 'required|min:6',
            'cpassword' => 'required|min:6|same:password'
        ]);

        $updatePassword = DB::table('password_resets')->where(['token' => $request->token])->first();
        if(!$updatePassword){
            toastr()->error(__('Link Expired, please request for a new link'));
            return back()->withInput();
        }

        $user = User::where('email', $updatePassword->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();

        toastr()->success(__('Your password has been changed!'));
        return redirect(route('login'));
    }

    public function register(Request $request){
        $data['title'] = __('Register');
        return view('unauthorized.register', $data);
    }

    public function registerSave(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'cpassword' => 'required|min:6|same:password'
        ]);

        try {
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if ($user){
                toastr()->success(__('Registered Successfully'));
                Mail::to($request->email)->send(new RegistrationConfirmation($request->name, $request->email, $request->password));
                return redirect(route('login'));
            }else {
                toastr()->error(__('Something went wrong!, Please try again'));
                return redirect(route('register'));
            }
        } catch (\Throwable $th) {
            Log::debug(__('Excpetion whille creating user'. $th->getMessage()));
            toastr()->error(__('Something went wrong!, Please try again'));
            return redirect(route('register'));
        }        
    }
}
