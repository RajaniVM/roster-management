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
        Schema::create('rosters', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('checkin_local')->nullable();
            $table->string('checkin_utc')->nullable();
            $table->string('checkout_local')->nullable();
            $table->string('checkout_utc')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('activity')->nullable();
            $table->string('from_station')->nullable();
            $table->string('std_local')->nullable();
            $table->string('std_utc')->nullable();
            $table->string('to_station')->nullable();
            $table->string('sta_local')->nullable();
            $table->string('sta_utc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rosters', function (Blueprint $table) {
            $table->dropColumn([
                'date', 'checkin_local', 'checkin_utc', 'checkout_local', 'checkout_utc',
                'activity_type', 'activity', 'from_station', 'std_local', 'std_utc', 'to_station',
                'sta_local', 'sta_utc'
            ]);
        });
    }
};

