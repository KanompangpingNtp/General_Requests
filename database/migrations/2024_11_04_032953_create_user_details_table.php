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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id(); // details_id
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('salutation'); //คำนำหน้า
            $table->integer('age');
            $table->string('phone');
            $table->string('house_number');
            $table->string('village');
            $table->string('subdistrict');
            $table->string('district');
            $table->string('province');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
