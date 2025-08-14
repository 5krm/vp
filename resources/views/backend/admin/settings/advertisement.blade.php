@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Advertisement Settings</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <h4>Manage Ads</h4>
                <form id="advertisement-form" action="{{ route('admin.settings.advertisement.update') }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-5 col-sm-3">
                      <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a 
                          class="nav-link active" 
                          id="vert-tabs-adModAndroid-tab" 
                          data-toggle="pill" 
                          href="#vert-tabs-adModAndroid"
                          role="tab" 
                          aria-controls="vert-tabs-adModAndroid" 
                          aria-selected="true"
                        >
                          AdMod(Android)
                        </a>
                        <a 
                          class="nav-link" 
                          id="vert-tabs-adModIOS-tab" 
                          data-toggle="pill" 
                          href="#vert-tabs-adModIOS"
                          role="tab" 
                          aria-controls="vert-tabs-adModIOS" 
                          aria-selected="false"
                        >
                          AdMod(IOS)
                        </a>
                        <a 
                          class="nav-link" 
                          id="vert-tabs-facebookAndroid-tab" 
                          data-toggle="pill" 
                          href="#vert-tabs-facebookAndroid"
                          role="tab" 
                          aria-controls="vert-tabs-facebookAndroid" 
                          aria-selected="false"
                        >
                          Facebook(Android)
                        </a>
                        <a 
                          class="nav-link" 
                          id="vert-tabs-facebookIOS-tab" 
                          data-toggle="pill" 
                          href="#vert-tabs-facebookIOS"
                          role="tab" 
                          aria-controls="vert-tabs-facebookIOS" 
                          aria-selected="false"
                        >
                          Facebook(IOS)
                        </a>
                        <a 
                          class="nav-link" 
                          id="vert-tabs-unityAds-tab" 
                          data-toggle="pill" 
                          href="#vert-tabs-unityAds"
                          role="tab" 
                          aria-controls="vert-tabs-unityAds  " 
                          aria-selected="false"
                        >
                          Unity Ads
                        </a>
                        <a 
                          class="nav-link" 
                          id="vert-tabs-ironSource-tab" 
                          data-toggle="pill" 
                          href="#vert-tabs-ironSource"
                          role="tab" 
                          aria-controls="vert-tabs-ironSource" 
                          aria-selected="false"
                        >
                          ironSource 
                        </a>
                        <a 
                          class="nav-link" 
                          id="vert-tabs-globalConfiguration-tab" 
                          data-toggle="pill" 
                          href="#vert-tabs-globalConfiguration"
                          role="tab" 
                          aria-controls="vert-tabs-globalConfiguration" 
                          aria-selected="false"
                        >
                          Global Configuration
                        </a>
                      </div>
                    </div>
                    <div class="col-7 col-sm-9">
                      <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="vert-tabs-adModAndroid" role="tabpanel" aria-labelledby="vert-tabs-adModAndroid-tab">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>AdMob Publisher Account ID</h6>
                                <input type="text" class="form-control" name="admob_android_publisher_account_id" value="{{ old('admob_android_publisher_account_id', $advertisement->admob_android_publisher_account_id ?? '') }}" placeholder="AdMob Publisher Account ID">
                              </div>
                              <div class="form-group">
                                <h6>AdMob Banner Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_android_banner_ad_unit_id" value="{{ old('admob_android_banner_ad_unit_id', $advertisement->admob_android_banner_ad_unit_id ?? '') }}" placeholder="AdMob Banner Ad Unit ID">
                              </div>
                              <div class="form-group">
                                <h6>AdMob Interstitial Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_android_interstitial_ad_unit_id" value="{{ old('admob_android_interstitial_ad_unit_id', $advertisement->admob_android_interstitial_ad_unit_id ?? '') }}" placeholder="AdMob Interstitial Ad Unit ID.">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>AdMob Native Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_android_native_ad_unit_id" value="{{ old('admob_android_native_ad_unit_id', $advertisement->admob_android_native_ad_unit_id ?? '') }}" placeholder="AdMob Native Ad Unit ID">
                              </div>
                              <div class="form-group">
                                <h6>AdMob Reward Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_android_reward_ad_unit_id" value="{{ old('admob_android_reward_ad_unit_id', $advertisement->admob_android_reward_ad_unit_id ?? '') }}" placeholder="AdMob Reward Ad Unit ID">
                              </div>
                              <div class="form-group">
                                <h6>AdMob App Open Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_android_app_open_ad_unit_id" value="{{ old('admob_android_app_open_ad_unit_id', $advertisement->admob_android_app_open_ad_unit_id ?? '') }}" placeholder="AdMob App Open Ad Unit ID">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-adModIOS" role="tabpanel" aria-labelledby="vert-tabs-adModIOS-tab">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>AdMob Banner Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_ios_banner_ad_unit_id" value="{{ old('admob_ios_banner_ad_unit_id', $advertisement->admob_ios_banner_ad_unit_id ?? '') }}" placeholder="AdMob Banner Ad Unit ID">
                              </div>
                              <div class="form-group">
                                <h6>AdMob Interstitial Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_ios_interstitial_ad_unit_id" value="{{ old('admob_ios_interstitial_ad_unit_id', $advertisement->admob_ios_interstitial_ad_unit_id ?? '') }}" placeholder="AdMob Interstitial Ad Unit ID.">
                              </div>
                              <div class="form-group">
                                <h6>AdMob Native Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_ios_native_ad_unit_id" value="{{ old('admob_ios_native_ad_unit_id', $advertisement->admob_ios_native_ad_unit_id ?? '') }}" placeholder="AdMob Native Ad Unit ID">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>AdMob Reward Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_ios_reward_ad_unit_id" value="{{ old('admob_ios_reward_ad_unit_id', $advertisement->admob_ios_reward_ad_unit_id ?? '') }}" placeholder="AdMob Reward Ad Unit ID">
                              </div>
                              <div class="form-group">
                                <h6>AdMob App Open Ad Unit ID</h6>
                                <input type="text" class="form-control" name="admob_ios_app_open_ad_unit_id" value="{{ old('admob_ios_app_open_ad_unit_id', $advertisement->admob_ios_app_open_ad_unit_id ?? '') }}" placeholder="AdMob App Open Ad Unit ID">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-facebookAndroid" role="tabpanel" aria-labelledby="vert-tabs-facebookAndroid-tab">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>Facebook Banner Ad Unit ID</h6>
                                <input type="text" class="form-control" name="facebook_android_banner_ad_unit_id" value="{{ old('facebook_android_banner_ad_unit_id', $advertisement->facebook_android_banner_ad_unit_id ?? '') }}" placeholder="Facebook Banner Ad Unit ID">
                              </div>
                              <div class="form-group">
                                <h6>Facebook Interstitial Ad Unit ID</h6>
                                <input type="text" class="form-control" name="facebook_android_interstitial_ad_unit_id" value="{{ old('facebook_android_interstitial_ad_unit_id', $advertisement->facebook_android_interstitial_ad_unit_id ?? '') }}" placeholder="Facebook Interstitial Ad Unit ID.">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>Facebook Native Ad Unit ID</h6>
                                <input type="text" class="form-control" name="facebook_android_native_ad_unit_id" value="{{ old('facebook_android_native_ad_unit_id', $advertisement->facebook_android_native_ad_unit_id ?? '') }}" placeholder="Facebook Native Ad Unit ID">
                              </div>
                              <div class="form-group">
                                <h6>Facebook Reward Ad Unit ID</h6>
                                <input type="text" class="form-control" name="facebook_android_reward_ad_unit_id" value="{{ old('facebook_android_reward_ad_unit_id', $advertisement->facebook_android_reward_ad_unit_id ?? '') }}" placeholder="Facebook Reward Ad Unit ID">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-facebookIOS" role="tabpanel" aria-labelledby="vert-tabs-facebookIOS-tab">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>Facebook Banner Ad Unit ID</h6>
                                <input type="text" class="form-control" name="facebook_ios_banner_ad_unit_id" value="{{ old('facebook_ios_banner_ad_unit_id', $advertisement->facebook_ios_banner_ad_unit_id ?? '') }}" placeholder="Facebook Banner Ad Unit ID">
                              </div>
                              <div class="form-group">
                                <h6>Facebook Interstitial Ad Unit ID</h6>
                                <input type="text" class="form-control" name="facebook_ios_interstitial_ad_unit_id" value="{{ old('facebook_ios_interstitial_ad_unit_id', $advertisement->facebook_ios_interstitial_ad_unit_id ?? '') }}" placeholder="Facebook Interstitial Ad Unit ID.">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>Facebook Native Ad Unit ID</h6>
                                <input type="text" class="form-control" name="facebook_ios_native_ad_unit_id" value="{{ old('facebook_ios_native_ad_unit_id', $advertisement->facebook_ios_native_ad_unit_id ?? '') }}" placeholder="Facebook Native Ad Unit ID">
                              </div>
                              <div class="form-group">
                                <h6>Facebook Reward Ad Unit ID</h6>
                                <input type="text" class="form-control" name="facebook_ios_reward_ad_unit_id" value="{{ old('facebook_ios_reward_ad_unit_id', $advertisement->facebook_ios_reward_ad_unit_id ?? '') }}" placeholder="Facebook Reward Ad Unit ID">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-unityAds" role="tabpanel" aria-labelledby="vert-tabs-unityAds-tab">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>Unity Game ID</h6>
                                <input type="text" class="form-control" name="unity_game_id" value="{{ old('unity_game_id', $advertisement->unity_game_id ?? '') }}" placeholder="Unity Game ID">
                              </div>
                              <div class="form-group">
                                <h6>Unity Banner Ad Placement ID</h6>
                                <input type="text" class="form-control" name="unity_banner_ad_placement_id" value="{{ old('unity_banner_ad_placement_id', $advertisement->unity_banner_ad_placement_id ?? '') }}" placeholder="Unity Banner Ad Placement ID">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>Unity Interstitial Ad Placement ID</h6>
                                <input type="text" class="form-control" name="unity_interstitial_ad_placement_id" value="{{ old('unity_interstitial_ad_placement_id', $advertisement->unity_interstitial_ad_placement_id ?? '') }}" placeholder="Unity Interstitial Ad Placement ID">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-ironSource" role="tabpanel" aria-labelledby="vert-tabs-ironSource-tab">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>ironSource App Key</h6>
                                <input type="text" class="form-control" name="ironsource_app_key" value="{{ old('ironsource_app_key', $advertisement->ironsource_app_key ?? '') }}" placeholder="ironSource App Key">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-globalConfiguration" role="tabpanel" aria-labelledby="vert-tabs-globalConfiguration-tab">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>Interstitial Ad Interval</h6>
                                <input type="text" class="form-control" name="interstitial_ad_interval" value="{{ old('interstitial_ad_interval', $advertisement->interstitial_ad_interval ?? '') }}" placeholder="Interstitial Ad Interval">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h6>Native Ad Index</h6>
                                <input type="text" class="form-control" name="native_ad_index" value="{{ old('native_ad_index', $advertisement->native_ad_index ?? '') }}" placeholder="Native Ad Index">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <h6>Ads Type</h6>
                                <select name="ads_type" id="ads_type" class="form-control">
                                  <option disabled selected value="0">Select an Option</option>
                                  <option value="0" @if(isset($advertisement) && $advertisement->ads_type == '0') selected @endif>AdMod</option>
                                  <option value="1" @if(isset($advertisement) && $advertisement->ads_type == '1') selected @endif>Facebook</option>
                                  <option value="2" @if(isset($advertisement) && $advertisement->ads_type == '3') selected @endif>Unity Ads</option>
                                  <option value="3" @if(isset($advertisement) && $advertisement->ads_type == '4') selected @endif>ironSource</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <button type="submit" class="btn btn-primary customButton">Update</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@push('scripts')
<script>
  $('#advertisement-form').on('submit', function(e) {
    e.preventDefault(); 
    const form = $(this);
    const formData = new FormData(this);

    $.ajax({
      url: form.attr('action'),
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        if(response.status == 'success') {
          successToast(response.message);
        }
      },
      error: function(xhr) {
        // Handle errors and show them
        const errors = xhr.responseJSON.errors;
        for (const key in errors) {
          errorToast(errors[key][0]);
        }
      }
    });
  });
</script>
@endpush
