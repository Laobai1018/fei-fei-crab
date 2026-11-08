@extends('layouts.app')
@section('title', $c->exists ? 'Edit customer' : 'Add customer')
@section('content')
<div class="card">
<h1>{{ $c->exists ? 'Edit customer' : 'Add customer' }}</h1>
<form method="POST" action="{{ $c->exists ? route('admin.customers.update', $c) : route('admin.customers.store') }}">@csrf
@if($c->exists) @method('PUT') @endif
@foreach($errors->all() as $e)<div class="err">{{ $e }}</div>@endforeach
<label for="name">Name</label><input id="name" name="name" value="{{ old('name', $c->name) }}" required>
<label for="phone">Phone number</label><input id="phone" name="phone" type="tel" value="{{ old('phone', $c->phone) }}" required>
<p class="row"><button class="btn">Save customer</button><a class="btn alt" href="{{ route('admin.customers.index') }}">Cancel</a></p>
</form>
</div>
@endsection
