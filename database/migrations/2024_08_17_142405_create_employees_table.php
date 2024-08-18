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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dob');
            $table->foreignId('role_id');
            $table->string('employee_id')->unique();
            $table->bigInteger('cnic');
            $table->date('d_i');
            $table->date('d_e');
            $table->string('blood');
            $table->string('office_no');
            $table->string('contact_no');
            $table->string('address');
            $table->bigInteger('account_no');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
