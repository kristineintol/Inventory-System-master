@extends('dashboard.body.main')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto my-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-circle-check"></i></div>
                        Procurements
                    </h1>
                </div>
                <div class="col-auto my-4">
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('requisitions.index') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-eye me-3"></i>Check Requisition</a>
                    @endif
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Procurements</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- BEGIN: Alert -->
    <div class="container-xl px-4 mt-n4">
        @if (session()->has('success'))
        <div class="alert alert-success alert-icon" role="alert">
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-icon-aside">
                <i class="far fa-flag"></i>
            </div>
            <div class="alert-icon-content">
                {{ session('success') }}
            </div>
        </div>
        @endif
    </div>
    <!-- END: Alert -->
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container px-2 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mx-n4">
                <div class="col-lg-12 card-header mt-n4">
                    <form action="{{ route('procurements.index') }}" method="GET">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="form-group row align-items-center">
                                <label for="row" class="col-auto">Rows:</label>
                                <div class="col-auto">
                                    <select class="form-control" name="row">
                                        <option value="10" @if(request('row') == '10') selected="selected" @endif>10</option>
                                        <option value="25" @if(request('row') == '25') selected="selected" @endif>25</option>
                                        <option value="50" @if(request('row') == '50') selected="selected" @endif>50</option>
                                        <option value="100" @if(request('row') == '100') selected="selected" @endif>100</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-between">
                                <label class="control-label col-sm-3" for="search">Search:</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search requisition" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-search font-size-20 text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Material Code</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $rowNumber = ($requisitions->currentPage() - 1) * $requisitions->perPage() + 1;
                                @endphp
                                @foreach ($requisitions as $requisition)
                                <tr>
                                    <th scope="row">{{ $rowNumber }}</th>
                                    <td>{{ $requisition->product->material_code }}</td>
                                    <td>{{ $requisition->description }}</td>
                                    <td>{{ $requisition->quantity }}</td>
                                    <td>{{ $requisition->price }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('procurements.show', $requisition->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            @if (auth()->user()->is_admin)
                                                <a href="{{ route('procurements.edit', $requisition->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('procurements.destroy', $requisition->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this requisition?')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $rowNumber++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $requisitions->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection
