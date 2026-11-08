@extends('layouts.app')
@section('title', 'Book a table')
@section('content')
<h1>Book a table</h1>
<p class="muted">{{ $customer ? 'Hi, '.$customer->name.'.' : 'You are booking as a guest.' }} Open 9:30 AM – 9:30 PM.</p>
<div class="card" style="max-width:520px">
<form method="POST" action="{{ route('book.store') }}">@csrf
@foreach($errors->all() as $e)<div class="err">{{ $e }}</div>@endforeach
<label for="booking_date">Date</label>
<input id="booking_date" name="booking_date" type="date" min="{{ now()->toDateString() }}" value="{{ old('booking_date') }}" required>
<label for="booking_time">Time</label>
<input id="booking_time" name="booking_time" type="time" min="09:30" max="21:30" step="900" value="{{ old('booking_time', '18:30') }}" required>
<label for="pax">Number of guests</label>
<input id="pax" name="pax" type="number" min="1" max="50" value="{{ old('pax', 2) }}" required>
<label for="name">Name</label>
<input id="name" name="name" value="{{ old('name', $customer->name ?? '') }}" required>
<label for="phone">Phone</label>
<input id="phone" name="phone" type="tel" value="{{ old('phone', $customer->phone ?? '') }}" required>
<label for="notes">Notes (optional)</label>
<textarea id="notes" name="notes" placeholder="Allergies, celebration, high chair">{{ old('notes') }}</textarea>
<p><button class="btn">Request booking</button></p>
</form>
</div>
@endsection
