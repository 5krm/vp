<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'admob_android_publisher_account_id',
        'admob_android_banner_ad_unit_id',
        'admob_android_interstitial_ad_unit_id',
        'admob_android_native_ad_unit_id',
        'admob_android_reward_ad_unit_id',
        'admob_android_app_open_ad_unit_id',
        'admob_ios_banner_ad_unit_id',
        'admob_ios_interstitial_ad_unit_id',
        'admob_ios_native_ad_unit_id',
        'admob_ios_reward_ad_unit_id',
        'admob_ios_app_open_ad_unit_id',
        'facebook_android_banner_ad_unit_id',
        'facebook_android_interstitial_ad_unit_id',
        'facebook_android_native_ad_unit_id',
        'facebook_android_reward_ad_unit_id',
        'facebook_ios_banner_ad_unit_id',
        'facebook_ios_interstitial_ad_unit_id',
        'facebook_ios_native_ad_unit_id',
        'facebook_ios_reward_ad_unit_id',
        'unity_game_id',
        'unity_banner_ad_placement_id',
        'unity_interstitial_ad_placement_id',
        'ironsource_app_key',
        'interstitial_ad_interval',
        'native_ad_index',
        'ads_type',
    ];
}
