@extends('layouts.guest')
@section('bodycontent')
<section class="h-screen">
    <div class="container px-6 py-12 h-full">
        <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
        <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
            <img src="{{ asset('assets/home.png') }}" alt="login image"/>
        </div>
        <div class="md:w-8/12 lg:w-5/12 lg:ml-20">
            <div class="flex items-center justify-center">
                <img class="justify-center" width="150px" height="150px" src="{{ asset('assets/logo.png') }}" alt="logo"/>
            </div>                    
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-800">Login</h2><br>
            @if (session('err'))
                <div class="text-black m-2 p-4 bg-red-200">
                    {{ session('err') }}
                </div>
            @endif
            <form class="mt-8 space-y-6" action="{{ route('login.post') }}" method="POST">
                @csrf
                <input type="hidden" name="remember" value="true">
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                    <label for="username" class="sr-only">Username</label>
                    <input id="username" name="username" type="text" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-emerald-500 focus:outline-none focus:ring-emerald-500 sm:text-sm" placeholder="Username">
                    </div>
                    <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-emerald-500 focus:outline-none focus:ring-emerald-500 sm:text-sm" placeholder="Password">
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-emerald-600 py-2 px-4 text-sm font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">          
                    Sign in
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
</section>
@endsection
