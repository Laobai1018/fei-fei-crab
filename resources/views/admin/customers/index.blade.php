@extends('layouts.app')
@section('title', 'Customers')
@section('content')
<div class="head"><h1 style="margin:0">Customers</h1><a class="btn" href="{{ route('admin.customers.create') }}">Add customer</a></div>
<div class="tw"><table>
<tr><th>Name</th><th>Phone</th><th>Bookings</th><th>Registered</th><th></th></tr>
@forelse($rows as $c)
<tr>
<td>{{ $c->name }}</td><td>{{ $c->phone }}</td><td>{{ $c->reservations_count }}</td><td>{{ $c->created_at->format('d M Y') }}</td>
<td><div class="row">
<a class="btn sm alt" href="{{ route('admin.customers.edit', $c) }}">Edit</a>
<form class="inline" method="POST" action="{{ route('admin.customers.destroy', $c) }}" onsubmit="return confirm('Delete this customer? Their bookings are kept.')">@csrf @method('DELETE')<button class="btn sm del">Delete</button></form>
</div></td>
</tr>
@empty
<tr><td colspan="5">No customers yet.</td></tr>
@endforelse
</table></div>
@endsection
