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
        Schema::table('biryani_dishes', function (Blueprint $table) {
            $table->dropForeign(['biryani_category_id']);
            $table->dropColumn('biryani_category_id');
        });

        Schema::dropIfExists('biryani_categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('biryani_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0);
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        Schema::table('biryani_dishes', function (Blueprint $table) {
            $table->foreignId('biryani_category_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
        });
    }
};
