@extends('layouts.app')
@section('bodycontent')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h5 class="font-bold text-center text-black">Profile</h5><br>
                <div class="flex justify-center">
                    <img width="120" height="180" src="{{ asset('assets/logo.png') }}" alt="logo"/>
                </div>
                @if (session('success'))
                    <div class="text-black m-2 p-4 bg-yellow-200">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('err'))
                    <div class="text-black m-2 p-4 bg-red-200">
                        {{ session('err') }}
                    </div>
                @endif       
                <h5 class="font-bold text-black">Change Password</h5><br>
                <form method="POST" action="">
                    @csrf
                    @method('put')                    
                    <input type="hidden" name="userid"  id="userid">
                    Current Password:
                    <br>
                    <input type="password" name="current_password" id="current_password" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="current password" required>
                    @if($errors->any('current_password'))
                        <span class="text-red-500">{{$errors->first('current_password')}}</span>
                    @endif
                    <br>
                    New Password:
                    <br>
                    <input type="password" name="password" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"placeholder="new password" required>
                    @if($errors->any('password'))
                        <span class="text-red-500">{{$errors->first('password')}}</span>
                    @endif
                    <br>
                    Confirm Password:
                    <br>
                    <input type="password" name="confirm_password" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="confirm password" required>
                    @if($errors->any('confirm_password'))
                        <span class="text-red-500">{{$errors->first('confirm_password')}}</span>
                    @endif
                    <br><br>                   
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection