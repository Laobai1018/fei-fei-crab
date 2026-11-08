<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $rows = Customer::withCount('reservations')->orderBy('name')->get();
        return view('admin.customers.index', compact('rows'));
    }

    public function create()
    {
        return view('admin.customers.form', ['c' => new Customer()]);
    }

    public function store(Request $q)
    {
        Customer::create($this->data($q));
        return redirect()->route('admin.customers.index')->with('ok', 'Customer added.');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.form', ['c' => $customer]);
    }

    public function update(Request $q, Customer $customer)
    {
        $customer->update($this->data($q, $customer));
        return redirect()->route('admin.customers.index')->with('ok', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete(); // their bookings stay, unlinked
        return redirect()->route('admin.customers.index')->with('ok', 'Customer deleted.');
    }

    private function data(Request $q, ?Customer $c = null): array
    {
        $q->merge(['phone' => Customer::clean($q->phone)]);
        return $q->validate([
            'name' => 'required|string|max:100',
            'phone' => ['required', 'regex:/^\+?[0-9]{8,15}$/', Rule::unique('customers', 'phone')->ignore($c?->id)],
        ]);
    }
}
