<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['customer_id', 'name', 'phone', 'booking_date', 'booking_time', 'pax', 'notes', 'status'];

    protected $casts = ['booking_date' => 'date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'phone' => ['required', 'regex:/^\+?[0-9]{8,15}$/'],
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => ['required', 'date_format:H:i', function ($attr, $v, $fail) {
                if ($v < '09:30' || $v > '21:30') {
                    $fail('We take bookings between 9:30 AM and 9:30 PM.');
                }
            }],
            'pax' => 'required|integer|min:1|max:50',
            'notes' => 'nullable|string|max:500',
        ];
    }
}
