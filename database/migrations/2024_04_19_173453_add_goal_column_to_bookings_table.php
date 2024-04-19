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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('goal')->nullable();
            $table->string('level')->nullable();
            $table->string('goal_in_details')->nullable();
            $table->string('level_of_daily_activity')->nullable();
            $table->text('describe_you_life_style')->nullable();
            $table->string('do_you_know_how_to_withdraw_your_calories')->nullable();
            $table->string('how_did_you_know_about_rawan')->nullable();
            $table->text('free_space_for_expression')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
