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
        Schema::table('packages', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('period')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('discount_value_when_renew')->nullable()->change();
            $table->integer('price')->nullable()->change();
            $table->string('member_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
};
