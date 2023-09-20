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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->text('details');
            $table->integer('payment_percent');
            $table->integer('first_payment_duration')->comment('in days');
            $table->integer('other_payment_duration')->comment('in days');
            $table->integer('total_emi')->comment('no. of months');
            $table->unsignedBigInteger('manager')->nullable();
            $table->timestamps();
            $table->foreign('manager')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
