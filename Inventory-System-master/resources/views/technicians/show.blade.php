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
                        Product Details
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
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
            <!-- BEGIN: Product Details -->
            <div class="card mb-4">
                <div class="card-header">
                    Product Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Form Group (sloc code) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="sloc_code">SLOC Code</label>
                                <input readonly class="form-control form-control-solid" id="sloc_code" name="sloc_code" type="text" placeholder="" value="{{ old('sloc_code', $product->sloc_code) }}" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Form Group (material code) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="material_code">Material Code</label>
                                <input readonly class="form-control form-control-solid" id="material_code" name="material_code" type="text" placeholder="" value="{{ old('material_code', $product->material_code) }}" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Form Group (sloc name) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="sloc_name">SLOC Name</label>
                                <input readonly class="form-control form-control-solid" id="sloc_name" name="sloc_name" type="text" placeholder="" value="{{ old('sloc_name', $product->sloc_name) }}" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Form Group (uom) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="uom">UOM</label>
                                <input readonly class="form-control form-control-solid" id="uom" name="uom" type="text" placeholder="" value="{{ old('uom', $product->uom) }}" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Form Group (sap_qty) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="sap_qty">SAP Quantity</label>
                                <input readonly class="form-control form-control-solid" id="sap_qty" name="sap_qty" type="text" placeholder="" value="{{ old('sap_qty', $product->sap_qty) }}" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Form Group (ac_qty) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="ac_qty">AC Quantity</label>
                                <input readonly class="form-control form-control-solid" id="ac_qty" name="ac_qty" type="text" placeholder="" value="{{ old('ac_qty', $product->ac_qty) }}" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Form Group (rec_qty) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="rec_qty">Rec Quantity</label>
                                <input readonly class="form-control form-control-solid" id="rec_qty" name="rec_qty" type="text" placeholder="" value="{{ old('rec_qty', $product->rec_qty) }}" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Form Group (variance_qty) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="variance_qty">Variance Quantity</label>
                                <input readonly class="form-control form-control-solid" id="variance_qty" name="variance_qty" type="text" placeholder="" value="{{ old('variance_qty', $product->variance_qty) }}" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                
                    <!-- Form Group (description) -->
                    <div class="mb-3">
                        <label class="small mb-1" for="description">Description</label>
                        <input readonly class="form-control form-control-solid" id="description" name="description" type="text" placeholder="" value="{{ old('description', $product->description) }}" autocomplete="off"/>
                    </div>
                </div>
            </div>
            <!-- END: Product Details -->
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
