@extends('layouts.app')
@section('title', $r->exists ? 'Edit booking' : 'Add booking')
@section('content')
<div class="card" style="max-width:520px">
<h1>{{ $r->exists ? 'Edit booking' : 'Add booking' }}</h1>
<form method="POST" action="{{ $r->exists ? route('admin.reservations.update', $r) : route('admin.reservations.store') }}">@csrf
@if($r->exists) @method('PUT') @endif
@foreach($errors->all() as $e)<div class="err">{{ $e }}</div>@endforeach
<label for="customer_id">Customer account (optional)</label>
<select id="customer_id" name="customer_id">
<option value="">Guest / walk-in</option>
@foreach($customers as $c)<option value="{{ $c->id }}" @selected(old('customer_id', $r->customer_id) == $c->id)>{{ $c->name }} ({{ $c->phone }})</option>@endforeach
</select>
<label for="name">Name</label><input id="name" name="name" value="{{ old('name', $r->name) }}" required>
<label for="phone">Phone</label><input id="phone" name="phone" type="tel" value="{{ old('phone', $r->phone) }}" required>
<label for="booking_date">Date</label><input id="booking_date" name="booking_date" type="date" value="{{ old('booking_date', $r->booking_date?->format('Y-m-d')) }}" required>
<label for="booking_time">Time</label><input id="booking_time" name="booking_time" type="time" min="09:30" max="21:30" step="900" value="{{ old('booking_time', $r->booking_time) }}" required>
<label for="pax">Number of guests</label><input id="pax" name="pax" type="number" min="1" max="50" value="{{ old('pax', $r->pax) }}" required>
<label for="status">Status</label>
<select id="status" name="status">@foreach(['pending','confirmed','cancelled'] as $s)<option value="{{ $s }}" @selected(old('status', $r->status) === $s)>{{ ucfirst($s) }}</option>@endforeach</select>
<label for="notes">Notes</label><textarea id="notes" name="notes">{{ old('notes', $r->notes) }}</textarea>
<p class="row"><button class="btn">Save booking</button><a class="btn alt" href="{{ route('admin.reservations.index') }}">Cancel</a></p>
</form>
</div>
@endsection
