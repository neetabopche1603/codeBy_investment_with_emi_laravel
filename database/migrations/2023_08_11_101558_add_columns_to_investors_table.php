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
        Schema::table('investors', function (Blueprint $table) {
            $table->string('adhaar',20)->nullable();
            $table->string('pan',12)->nullable();
            $table->string('bank_name',255)->nullable();
            $table->string('bank_account_holder_name',255)->nullable();
            $table->string('bank_account_no',255)->nullable();
            $table->string('bank_account_type',255)->nullable();
            $table->string('bank_ifsc',255)->nullable();
            $table->string('bank_branch_name',255)->nullable();
            $table->text('bank_remarks')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->dropColumn([
                'adhaar',
                'pan',
                'bank_name',
                'bank_account_holder_name',
                'bank_account_no',
                'bank_account_type',
                'bank_ifsc',
                'bank_branch_name',
                'bank_remarks'




            ]);
        });
    }
};
