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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('delivery_time_ar')->nullable()->change();
            $table->string('delivery_time_en')->nullable()->change();
            $table->string('working_hours_ar')->nullable()->change();
            $table->string('working_hours_en')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('delivery_time_ar')->nullable(false)->change();
            $table->string('delivery_time_en')->nullable(false)->change();
            $table->string('working_hours_ar')->nullable(false)->change();
            $table->string('working_hours_en')->nullable(false)->change();
        });
    }
};
