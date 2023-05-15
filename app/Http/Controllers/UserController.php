<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function index()
    {        
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->user_id);
        if($user)
        {
            $user->delete();
            return redirect()->route('users.index')->with('delete', 'User deleted successfully.');
        }
        else
        {
            return redirect()->route('users.index')->with('delete', 'No User found!.');
        }
    }
}

