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
        DB::table('settings')->insert([
            ['key' => 'hero_stat_ideas', 'value' => '500+', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'hero_stat_innovators', 'value' => '1.2K+', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'hero_stat_funding', 'value' => '₹50Cr+', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', ['hero_stat_ideas', 'hero_stat_innovators', 'hero_stat_funding'])->delete();
    }
};
