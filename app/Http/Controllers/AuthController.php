<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('sign-in/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'file'=>'required'
        ])->validate();

        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin',
        ]);

        if ($request->hasFile('file')) {
            $photoPath = $request->file('file')->store('images', 'public');
            $user->photo = $photoPath;
            $user->save();
        }
        return redirect()->route('login.action');
    }

    public function login()
    {
        return view('sign-in/login');
    }


    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = User::where('email', $credentials['email'])->first();

            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => 'No user with that email exists.',
                ]);
            }

            throw ValidationException::withMessages([
                'password' => 'Wrong credentials, The password is not correct',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('AdminDashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/logins');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:5'],
        ]);
    
        $userId = Auth::id();
        $user = User::find($userId);
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password does not exists']);
        }
    
        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors(['password_confirmation' => 'The new password and confirmation password do not match.']);
        }
    
        $user->update([
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('AdminDashboard')->with('status', 'Password changed successfully.');
    }

    public function profile()
    {
        return view('profile');
    }

    public function profileSetting(Request $request, string $id)
    {
        $profile = User::findOrFail($id);
        $previousPhoto = $profile->photo;  
        $profile->update($request->all());
    
        if ($request->hasFile('file')) {
            $newPhoto = $request->file('file');
        
            $newPhotoPath = $newPhoto->store('images', 'public');
    
            $profile->photo = $newPhotoPath;
            $profile->save();
        
            if ($previousPhoto && Storage::disk('public')->exists($previousPhoto)) {
                Storage::disk('public')->delete($previousPhoto);
            }
        }
      
        return redirect()->route('profile')->with('success', 'profile updated successfully');
    
    }
}
