@extends('dashboard.body.main')

@section('specificpagescripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endsection

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Edit Procurement
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('procurements.index') }}">Procurements</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('procurements.update', $requisition->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">
            <div class="col">
                <!-- BEGIN: Requisition Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Procurement Details
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Form Group (Product ID) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="product_id">Select Product</label>
                                    <select class="form-select form-control-solid @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                        <option value="" disabled>Select a Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ old('product_id', $requisition->product_id) == $product->id ? 'selected' : '' }}>
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
                                    <textarea class="form-control form-control-solid @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter description" required>{{ old('description', $requisition->description) }}</textarea>
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
                                    <input class="form-control form-control-solid @error('quantity') is-invalid @enderror" id="quantity" name="quantity" type="number" placeholder="Enter quantity" value="{{ old('quantity', $requisition->quantity) }}" required autocomplete="off"/>
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
                                    <input class="form-control form-control-solid @error('price') is-invalid @enderror" id="price" name="price" type="text" placeholder="Enter price" value="{{ old('price', $requisition->price) }}" required autocomplete="off"/>
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Form Group (Product ID) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="technician_id">Select Technician</label>
                                    <select class="form-select form-control-solid @error('technician_id') is-invalid @enderror" id="technician_id" name="technician_id" required>
                                        <option value="" disabled>Select a Product</option>
                                        @foreach ($technicians as $technician)
                                            <option value="{{ $technician->id }}" {{ old('technician_id', $requisition->technician_id) == $technician->id ? 'selected' : '' }}>
                                                {{ $technician->fname }} {{ $technician->mname }}. {{ $technician->lname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('technician_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Form Group (Quantity) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="status">Status</label>
                                    <select class="form-select form-control-solid @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="" disabled>Select a Product</option>
                                        <option value="1">Approve</option>
                                        <option value="0">Decline</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a class="btn btn-danger" href="{{ route('procurements.index') }}">Cancel</a>
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
