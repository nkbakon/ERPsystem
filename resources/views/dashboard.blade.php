@extends('layouts.app')
@section('bodycontent')
<h1 class="text-center font-bold text-gray-600">Welcome {{ auth()->user()->fname }} {{ auth()->user()->lname }} ({{ auth()->user()->username }})</h1>
@endsection
