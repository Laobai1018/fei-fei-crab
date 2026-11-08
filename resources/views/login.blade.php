@extends('layouts.app')
@section('title', 'Log in')
@section('content')
<h1>Welcome to Fei Fei Crab</h1>
<p class="muted">Log in to book a table. Open 9:30 AM – 9:30 PM.</p>
<div class="grid">
<div class="card">
<h2>Customer</h2>
<form method="POST" action="{{ route('login.customer') }}">@csrf
<label for="phone">Phone number</label>
<input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required>
@error('phone', 'customer')<div class="err">{{ $message }}</div>@enderror
<p><button class="btn">Log in</button></p>
</form>
<form method="POST" action="{{ route('login.guest') }}">@csrf<button class="btn alt">Continue as guest</button></form>
<p class="muted">New here? <a href="{{ route('register') }}">Register with your name and phone number</a></p>
</div>
<div class="card">
<h2>Admin</h2>
<form method="POST" action="{{ route('login.admin') }}">@csrf
<label for="email">Email</label>
<input id="email" name="email" type="email" value="{{ old('email') }}" required>
@error('email', 'admin')<div class="err">{{ $message }}</div>@enderror
<label for="password">Password</label>
<input id="password" name="password" type="password" required>
<p><button class="btn">Log in as admin</button></p>
</form>
</div>
</div>
@endsection
