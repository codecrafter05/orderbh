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
            $table->text('keywords_ar')->nullable()->after('working_hours_en');
            $table->text('keywords_en')->nullable()->after('keywords_ar');
            $table->text('description_ar')->nullable()->after('keywords_en');
            $table->text('description_en')->nullable()->after('description_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['keywords_ar', 'keywords_en', 'description_ar', 'description_en']);
        });
    }
};
