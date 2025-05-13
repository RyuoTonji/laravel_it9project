<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('resource_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resources_id')->constrained('resources')->onDelete('cascade');
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('resource_bookings');
    }
};