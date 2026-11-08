<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', fn (Blueprint $t) => $t->boolean('is_admin')->default(false));

        Schema::create('customers', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('phone')->unique();
            $t->timestamps();
        });

        Schema::create('reservations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $t->string('name');
            $t->string('phone');
            $t->date('booking_date');
            $t->string('booking_time', 5);
            $t->unsignedSmallInteger('pax');
            $t->string('notes', 500)->nullable();
            $t->string('status')->default('pending');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('customers');
        Schema::table('users', fn (Blueprint $t) => $t->dropColumn('is_admin'));
    }
};
