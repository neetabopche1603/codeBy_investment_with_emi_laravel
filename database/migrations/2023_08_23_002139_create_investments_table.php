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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id');
            $table->unsignedBigInteger('investment_amount');
            $table->unsignedBigInteger('investment_plan_id');
            $table->unsignedBigInteger('manager_id');
            $table->date('investment_date');
            $table->timestamps();
            $table->foreign('investor_id')->references('id')->on('investors');
            $table->foreign('investment_plan_id')->references('id')->on('plans');
            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropForeign(['investor_id']);
            $table->dropForeign(['investment_plan_id']);
            $table->dropForeign(['manager_id']);
        });

        Schema::dropIfExists('investments');
    }
};
