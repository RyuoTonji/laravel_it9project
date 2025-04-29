<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

  public function RegisterUser(Request $request) {
    $CREDENTIALS = $request->validateWithBag('register', [
      'Username' => 'required|unique:users',
      'Email' => 'required|email|unique:users',
      'Password' => 'required|min:6|confirmed',
      'ConfirmPassword' => 'required|same:Password',
    ]);

    User::create([
      'Username' => $CREDENTIALS['Username'],
      'Email' => $CREDENTIALS['Email'],
      'Password' => Hash::make($CREDENTIALS['Password']),
    ]);

    return back()->with('toast_success', 'Registration successful! You can now log in.');
  }

  public function LoginUser(Request $request) {
    $CREDENTIALS = $request->validateWithBag('login',[
      'Email' => 'required|email',
      'Password' => 'required',
    ]);
    if (!Auth::attempt($CREDENTIALS)) {
      return back()->with('toast_error', 'Login failed. Check your credentials.')->withInput($request->only('Email'));
    }

    return back()->with('toast_success', 'Login successful!');
  }

  public function LogoutUser(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return back()->with('toast_success', 'Logout successful!');
  }
}
