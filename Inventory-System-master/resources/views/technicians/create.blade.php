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
                        Add Technician
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('technicians.index') }}">Technicians</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('technicians.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <!-- BEGIN: Technician Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Technician Details
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Form Group (First Name) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="fname">First Name</label>
                                    <input class="form-control form-control-solid @error('fname') is-invalid @enderror" id="fname" name="fname" type="text" placeholder="Enter first name" value="{{ old('fname') }}" required autocomplete="off"/>
                                    @error('fname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Form Group (Last Name) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="lname">Last Name</label>
                                    <input class="form-control form-control-solid @error('lname') is-invalid @enderror" id="lname" name="lname" type="text" placeholder="Enter last name" value="{{ old('lname') }}" required autocomplete="off"/>
                                    @error('lname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Form Group (Middle Name) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="mname">Middle Name</label>
                                    <input class="form-control form-control-solid" id="mname" name="mname" type="text" placeholder="Enter middle name" value="{{ old('mname') }}" autocomplete="off"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Form Group (Email) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control form-control-solid @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Enter email" value="{{ old('email') }}" required autocomplete="off"/>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Form Group (Phone) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control form-control-solid @error('phone') is-invalid @enderror" id="phone" name="phone" type="text" placeholder="Enter phone number" value="{{ old('phone') }}" required autocomplete="off"/>
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form Group (Address) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="address">Address</label>
                            <input class="form-control form-control-solid @error('address') is-invalid @enderror" id="address" name="address" type="text" placeholder="Enter address" value="{{ old('address') }}" required autocomplete="off"/>
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a class="btn btn-danger" href="{{ route('technicians.index') }}">Cancel</a>
                        </div>
                    </div>
                </div>
                <!-- END: Technician Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
