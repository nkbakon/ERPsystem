<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        if(Hash::check($request->current_password,$user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('profile.edit')->with('success', 'Password updated successfully.');
        }else{
            return redirect()->route('profile.edit')->with('err', 'Invalid current password.');            
        }        
    }
}

