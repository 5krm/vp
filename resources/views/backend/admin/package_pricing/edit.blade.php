@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Edit Pricing</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ route('admin.pricings.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Package Name</label>
                    <input type="text" class="form-control" name="package_name" value="{{ old('package_name', $pricing->package_name) }}" placeholder="Package Name">
                    <input type="hidden" class="form-control" name="pricing_id" value="{{ $pricing->id }}">
                  </div>
                  <div class="form-group">
                    <label>Product ID</label>
                    <input type="text" class="form-control" name="product_id" value="{{ old('product_id', $pricing->product_id) }}" placeholder="Product ID">
                  </div>
                  <div class="form-group">
                    <label>Package Duration (in days)</label>
                    <input type="text" class="form-control" name="package_duration" value="{{ old('package_duration', $pricing->package_duration) }}" placeholder="Package Duration (in days)">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="package_price" value="{{ old('package_price', $pricing->package_price) }}" placeholder="Price">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="0" @if($pricing->status == '0') selected @endif>Active</option>
                      <option value="1" @if($pricing->status == '1') selected @endif>Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary customButton">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection