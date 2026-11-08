<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $r)
    {
        return view('booking', ['customer' => Customer::find($r->session()->get('customer_id'))]);
    }

    public function store(Request $r)
    {
        $r->merge(['phone' => Customer::clean($r->phone)]);
        $d = $r->validate(Reservation::rules());
        Reservation::create($d + ['customer_id' => $r->session()->get('customer_id'), 'status' => 'pending']);
        return redirect()->route('book')->with('ok', 'Booking sent. We will confirm it with you shortly.');
    }
}
