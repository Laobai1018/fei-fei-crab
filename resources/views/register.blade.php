@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="card">
<h1>Register</h1>
<form method="POST" action="{{ route('register') }}">@csrf
@foreach($errors->all() as $e)<div class="err">{{ $e }}</div>@endforeach
<label for="name">Name</label>
<input id="name" name="name" value="{{ old('name') }}" required>
<label for="phone">Phone number</label>
<input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required>
<p><button class="btn">Register and continue</button></p>
</form>
<a href="{{ route('login') }}">Back to log in</a>
</div>
@endsection
