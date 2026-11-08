<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public static function clean(?string $phone): string
    {
        return preg_replace('/[^\d+]/', '', (string) $phone);
    }
}
