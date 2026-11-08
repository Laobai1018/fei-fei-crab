<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function admin(Request $r)
    {
        $c = $r->validateWithBag('admin', ['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($c + ['is_admin' => true])) {
            $r->session()->regenerate();
            return redirect()->route('admin.reservations.index');
        }
        return back()->withErrors(['email' => 'Wrong email or password.'], 'admin')->onlyInput('email');
    }

    public function customer(Request $r)
    {
        $r->merge(['phone' => Customer::clean($r->phone)]);
        $r->validateWithBag('customer', ['phone' => 'required']);
        $customer = Customer::where('phone', $r->phone)->first();
        if (! $customer) {
            return back()->withErrors(['phone' => 'No account with this phone number. Register, or continue as a guest.'], 'customer')->onlyInput('phone');
        }
        $r->session()->regenerate();
        $r->session()->forget('guest');
        $r->session()->put('customer_id', $customer->id);
        return redirect()->route('book');
    }

    public function guest(Request $r)
    {
        $r->session()->regenerate();
        $r->session()->forget('customer_id');
        $r->session()->put('guest', true);
        return redirect()->route('book');
    }

    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $r)
    {
        $r->merge(['phone' => Customer::clean($r->phone)]);
        $d = $r->validate([
            'name' => 'required|string|max:100',
            'phone' => ['required', 'regex:/^\+?[0-9]{8,15}$/', 'unique:customers,phone'],
        ]);
        $customer = Customer::create($d);
        $r->session()->regenerate();
        $r->session()->forget('guest');
        $r->session()->put('customer_id', $customer->id);
        return redirect()->route('book');
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('login');
    }
}
