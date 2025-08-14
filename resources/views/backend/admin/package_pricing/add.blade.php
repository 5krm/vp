@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Add New Pricing</h1>
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
              <form action="{{ route('admin.pricings.insert') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Package Name</label>
                    <input type="text" class="form-control" name="package_name" value="{{ old('package_name') }}" placeholder="Package Name">
                  </div>
                  <div class="form-group">
                    <label>Product ID</label>
                    <input type="text" class="form-control" name="product_id" value="{{ old('product_id') }}" placeholder="Product ID">
                  </div>
                  <div class="form-group">
                    <label>Package Duration (in days)</label>
                    <input type="text" class="form-control" name="package_duration" value="{{ old('package_duration') }}" placeholder="Package Duration (in days)">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="package_price" value="{{ old('package_price') }}" placeholder="Price">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary customButton">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
