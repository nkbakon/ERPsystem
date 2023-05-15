@extends('layouts.app')
@section('bodycontent')
<nav class="bg-gray-50 dark:bg-gray-700">
    <div class="max-w-screen-xl px-4 py-3 mx-auto md:px-6">
        <div class="flex items-center">
            <ul class="flex flex-row mt-0 mr-6 space-x-8 text-sm font-medium">
                <li>
                    <a href="{{ route('items.index') }}" class="bg-gray-500 border-gray-600 text-white px-3 py-1 flex space-x-2 mt-5 rounded-md border border-gray-50 cursor-pointer hover:bg-gray-400 hover:border-gray-500 hover:text-gray-50">Items</a>
                </li>
                <li>
                    <a href="{{ route('itemdetails.index') }}" class="px-3 py-1 flex space-x-2 mt-5 rounded-md border border-gray-50 cursor-pointer hover:bg-gray-400 hover:border-gray-500 hover:text-gray-50">Details</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@if (session('status'))
    <div class="text-black m-2 p-4 bg-green-200">
        {{ session('status') }}
    </div>
@endif
@if (session('success'))
    <div class="text-black m-2 p-4 bg-yellow-200">
        {{ session('success') }}
    </div>
@endif
@if (session('delete'))
    <div class="text-black m-2 p-4 bg-red-200">
        {{ session('delete') }}
    </div>
@endif
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <a href="{{ route('items.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Add Item</a><br><br>                    
                
            </div>
        </div>
    </div>
</div>
@endsection