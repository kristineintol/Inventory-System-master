@extends('dashboard.body.main')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto my-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-shopping-cart"></i></div>
                        Create Requisition
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('requisitions.index') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-arrow-left me-3"></i>Back to Requisitions</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('requisitions.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <!-- BEGIN: Requisition Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Requisition Details
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Form Group (Product ID) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="product_id">Select Product</label>
                                    <select class="form-select form-control-solid @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                        <option value="" disabled selected>Select a Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id || count($products) == 1 ? 'selected' : '' }}>
                                                {{ $product->sloc_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <!-- Form Group (Description) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="description">Description</label>
                                    <input class="form-control form-control-solid @error('description') is-invalid @enderror" id="description" name="description" type="text" placeholder="Enter description" value="{{ old('description') }}" required autocomplete="off"/>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Form Group (Quantity) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="quantity">Quantity</label>
                                    <input class="form-control form-control-solid @error('quantity') is-invalid @enderror" id="quantity" name="quantity" type="text" placeholder="Enter quantity" value="{{ old('quantity') }}" required autocomplete="off"/>
                                    @error('quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Form Group (Price) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="price">Price</label>
                                    <input class="form-control form-control-solid @error('price') is-invalid @enderror" id="price" name="price" type="text" placeholder="Enter price" value="{{ old('price') }}" required autocomplete="off"/>
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a class="btn btn-danger" href="{{ route('requisitions.index') }}">Cancel</a>
                        </div>
                    </div>
                </div>
                <!-- END: Requisition Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
