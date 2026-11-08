@extends('layouts.app')
@section('title', 'Bookings')
@section('content')
<div class="head"><h1 style="margin:0">Bookings</h1><a class="btn" href="{{ route('admin.reservations.create') }}">Add booking</a></div>
<div class="tw"><table>
<tr><th>Date</th><th>Time</th><th>Guests</th><th>Name</th><th>Phone</th><th>Status</th><th>Notes</th><th></th></tr>
@forelse($rows as $r)
<tr>
<td>{{ $r->booking_date->format('d M Y') }}</td><td>{{ $r->booking_time }}</td><td>{{ $r->pax }}</td>
<td>{{ $r->name }}</td><td>{{ $r->phone }}</td><td>{{ ucfirst($r->status) }}</td><td>{{ \Illuminate\Support\Str::limit($r->notes, 30) }}</td>
<td><div class="row">
<a class="btn sm alt" href="{{ route('admin.reservations.edit', $r) }}">Edit</a>
<form class="inline" method="POST" action="{{ route('admin.reservations.destroy', $r) }}" onsubmit="return confirm('Delete this booking?')">@csrf @method('DELETE')<button class="btn sm del">Delete</button></form>
</div></td>
</tr>
@empty
<tr><td colspan="8">No bookings yet. Add one with the button above.</td></tr>
@endforelse
</table></div>
@endsection
