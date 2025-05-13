<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rooms_id')->constrained('rooms')->onDelete('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};