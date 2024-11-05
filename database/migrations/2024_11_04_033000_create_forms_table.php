<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id(); // form_id
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('date');
            $table->string('subject');
            $table->text('request_details');
            $table->enum('status', [1, 2]);
            $table->string('guest_salutation')->nullable();
            $table->string('guest_name')->nullable();
            $table->integer('guest_age')->nullable();
            $table->string('guest_phone')->nullable();
            $table->string('guest_house_number')->nullable();
            $table->string('guest_village')->nullable();
            $table->string('guest_subdistrict')->nullable();
            $table->string('guest_district')->nullable();
            $table->string('guest_province')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
