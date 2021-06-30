@extends('layouts.app', ['title' => 'Home'])

@section('content')
  <div class="h-screen bg-gray-50 flex items-center justify-center">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-md p-8 space-y-4">
      <h1>Logged in as {{ Auth::user()->name }}</h1>

      <a href="{{ route('logout') }}" class="text-indigo-600 inline-block underline mt-4">Logout</a>
    </div>
  </div>
@endsection
