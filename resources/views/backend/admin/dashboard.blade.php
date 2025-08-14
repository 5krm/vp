@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 textWhite">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <a href="{{ route('admin.countries.index') }}">
            <div class="small-box countries">
              <div class="icon-div" style="background-color: #373555;">
                <img src="{{ asset('assets/backend/dist/img/dashboard_icons/country.png') }}" style="" alt="">
              </div>
              <div class="inner">
                <h3>{{ $countries }}+</h3>
                <p>Countries</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="{{ route('admin.servers.index') }}">
            <div class="small-box servers">
              <div class="icon-div" style="background-color: #314055;">
                <img src="{{ asset('assets/backend/dist/img/dashboard_icons/server.png') }}" style="" alt="">
              </div>
              <div class="inner">
                <h3>{{ $servers }}+</h3>
                <p>Servers</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="{{ route('admin.pricings.index') }}">
            <div class="small-box pricings">
              <div class="icon-div" style="background-color: #384947;">
                <img src="{{ asset('assets/backend/dist/img/dashboard_icons/pricing.png') }}" style="" alt="">
              </div>
              <div class="inner">
                <h3>{{ $packagePricings }}+</h3>
                <p>Pricings</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="{{ route('admin.users.index') }}">
            <div class="small-box users">
              <div class="icon-div" style="background-color: #314055;">
                <img src="{{ asset('assets/backend/dist/img/dashboard_icons/user.png') }}" style="" alt="">
              </div>
              <div class="inner">
                <h3>{{ $allUsers }}+</h3>
                <p>All Users</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="{{ route('admin.users.index') }}">
            <div class="small-box pro-users">
              <div class="icon-div" style="background-color: #4c4a3b;">
                <img src="{{ asset('assets/backend/dist/img/dashboard_icons/pro-users.png') }}" style="" alt="">
              </div>
              <div class="inner">
                <h3>{{ $proUsers }}+</h3>
                <p>Pro Users</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="{{ route('admin.users.index') }}">
            <div class="small-box guest-users">
              <div class="icon-div" style="background-color: #4B3F3B;">
                <img src="{{ asset('assets/backend/dist/img/dashboard_icons/guest-users.png') }}" style="" alt="">
              </div>
              <div class="inner">
                <h3>{{ $guestUsers }}+</h3>
                <p>Guest Users</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="{{ route('admin.admins.index') }}">
            <div class="small-box admin">
              <div class="icon-div" style="background-color: #4c4a3b;">
                <img src="{{ asset('assets/backend/dist/img/dashboard_icons/admin.png') }}" style="" alt="">
              </div>
              <div class="inner">
                <h3>{{ $admins }}+</h3>
                <p>Admins</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection