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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('admob_android_publisher_account_id')->nullable();
            $table->string('admob_android_banner_ad_unit_id')->nullable();
            $table->string('admob_android_interstitial_ad_unit_id')->nullable();
            $table->string('admob_android_native_ad_unit_id')->nullable();
            $table->string('admob_android_reward_ad_unit_id')->nullable();
            $table->string('admob_android_app_open_ad_unit_id')->nullable();
            $table->string('admob_ios_banner_ad_unit_id')->nullable();
            $table->string('admob_ios_interstitial_ad_unit_id')->nullable();
            $table->string('admob_ios_native_ad_unit_id')->nullable();
            $table->string('admob_ios_reward_ad_unit_id')->nullable();
            $table->string('admob_ios_app_open_ad_unit_id')->nullable();
            $table->string('facebook_android_banner_ad_unit_id')->nullable();
            $table->string('facebook_android_interstitial_ad_unit_id')->nullable();
            $table->string('facebook_android_native_ad_unit_id')->nullable();
            $table->string('facebook_android_reward_ad_unit_id')->nullable();          
            $table->string('facebook_ios_banner_ad_unit_id')->nullable();          
            $table->string('facebook_ios_interstitial_ad_unit_id')->nullable();          
            $table->string('facebook_ios_native_ad_unit_id')->nullable();          
            $table->string('facebook_ios_reward_ad_unit_id')->nullable();          
            $table->string('unity_game_id')->nullable();          
            $table->string('unity_banner_ad_placement_id')->nullable();          
            $table->string('unity_interstitial_ad_placement_id')->nullable();          
            $table->string('ironsource_app_key')->nullable();          
            $table->string('interstitial_ad_interval')->nullable();          
            $table->string('native_ad_index')->nullable();          
            $table->string('ads_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
