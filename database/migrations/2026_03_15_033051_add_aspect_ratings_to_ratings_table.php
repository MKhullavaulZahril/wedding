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
        Schema::table('ratings', function (Blueprint $table) {
            $table->integer('rating_venue')->default(0)->after('overall_rating');
            $table->integer('rating_catering')->default(0)->after('rating_venue');
            $table->integer('rating_service')->default(0)->after('rating_catering');
            $table->integer('rating_price')->default(0)->after('rating_service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropColumn(['rating_venue', 'rating_catering', 'rating_service', 'rating_price']);
        });
    }
};
