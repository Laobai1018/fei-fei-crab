<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $rows = Reservation::orderByDesc('booking_date')->orderBy('booking_time')->get();
        return view('admin.reservations.index', compact('rows'));
    }

    public function create()
    {
        return view('admin.reservations.form', [
            'r' => new Reservation(['pax' => 2, 'status' => 'confirmed']),
            'customers' => Customer::orderBy('name')->get(),
        ]);
    }

    public function store(Request $q)
    {
        Reservation::create($this->data($q));
        return redirect()->route('admin.reservations.index')->with('ok', 'Booking added.');
    }

    public function edit(Reservation $reservation)
    {
        return view('admin.reservations.form', ['r' => $reservation, 'customers' => Customer::orderBy('name')->get()]);
    }

    public function update(Request $q, Reservation $reservation)
    {
        $reservation->update($this->data($q));
        return redirect()->route('admin.reservations.index')->with('ok', 'Booking updated.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('ok', 'Booking deleted.');
    }

    private function data(Request $q): array
    {
        $q->merge(['phone' => Customer::clean($q->phone)]);
        // Admins may enter or edit past dates, so the "today or later" rule is replaced here.
        return $q->validate([
            'booking_date' => 'required|date',
            'customer_id' => 'nullable|exists:customers,id',
            'status' => 'required|in:pending,confirmed,cancelled',
        ] + Reservation::rules());
    }
}
