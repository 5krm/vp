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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('login_system_type', ['device_id_required', 'email_password_only'])
                ->default('email_password_only')
                ->comment('Configures the login system. Options: "device_id_required" (login requires device ID) or "email_password_only".');
            $table->string('faq_url', 255)->nullable(); 
            $table->string('contact_us_url', 255)->nullable(); 
            $table->string('privacy_policy_url', 255)->nullable(); 
            $table->string('terms_and_conditions_url', 255)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
