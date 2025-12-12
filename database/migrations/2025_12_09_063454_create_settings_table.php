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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'contact_email', 'value' => 'support@ipsolutions.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_phone', 'value' => '+91 1234567890', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_address', 'value' => 'Innovation Hub, India', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
