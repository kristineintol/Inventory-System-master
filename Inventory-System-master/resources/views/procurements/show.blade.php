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
                        Procurement Details
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('procurements.index') }}">Procurements</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
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
                                <label class="small mb-1" for="product_id">Product ID</label>
                                <input readonly class="form-control form-control-solid" id="product_id" name="product_id" type="text" placeholder="" value="{{ $requisition->product_id }}" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Form Group (Description) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="description">Description</label>
                                <input readonly class="form-control form-control-solid" id="description" name="description" type="text" placeholder="" value="{{ $requisition->description }}" autocomplete="off"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Form Group (Quantity) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="quantity">Quantity</label>
                                <input readonly class="form-control form-control-solid" id="quantity" name="quantity" type="text" placeholder="" value="{{ $requisition->quantity }}" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Form Group (Price) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="price">Price</label>
                                <input readonly class="form-control form-control-solid" id="price" name="price" type="text" placeholder="" value="{{ $requisition->price }}" autocomplete="off"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <!-- Form Group (Product ID) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="technician_id">Technician</label>
                                <input readonly class="form-control form-control-solid" id="technician_id" name="technician_id" type="text" placeholder="" value="{{ $requisition->technician->fname }} {{ $requisition->technician->mname }}. {{ $requisition->technician->lname }}" autocomplete="off"/>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="mb-3">
                        @if (auth()->user()->is_admin)
                            <a class="btn btn-primary" href="{{ route('procurements.edit', $requisition->id) }}">Edit</a>
                        @endif
                        <a class="btn btn-danger" href="{{ route('procurements.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <!-- END: Requisition Details -->
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
