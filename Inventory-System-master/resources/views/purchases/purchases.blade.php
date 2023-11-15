@extends('dashboard.body.main')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto my-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-cash-register"></i></div>
                        Reports
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Reports</li>
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
                    <form action="#" method="GET">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="form-group row align-items-center">
                                <label for="row" class="col-auto">Row:</label>
                                <div class="col-auto">
                                    <select class="form-control" name="row">
                                        <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                        <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                        <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                        <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-between">
                                {{-- <label class="control-label col-sm-3" for="search">Search:</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search order" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20 text-white"></i></button>
                                        </div>
                                    </div>
                                </div> --}}
                                <button class="btn btn-primary text-uppercase" type="button" onclick="printReport()">Print</button>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="col-lg-12">
                    <div class="table-responsive"  id="reportTable">
                        <table class="table table-striped align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Material Code</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">SAP QTY</th>
                                    <th scope="col">AC QTY</th>
                                    <th scope="col">RECON QTY</th>
                                    <th scope="col">VARIANCE QTY</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Technician</th>
                                    @if (auth()->user()->is_admin)
                                        <th scope="col">Customer</th>
                                    @endif
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requisitions as $requisition)
                                <tr>
                                    <th scope="row">{{ (($requisitions->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>{{ $requisition->product->material_code }}</td>
                                    <td>{{ $requisition->quantity }}</td>
                                    <td>{{ $requisition->product->sap_qty }}</td>
                                    <td>{{ $requisition->product->ac_qty }}</td>
                                    <td>{{ $requisition->product->rec_qty }}</td>
                                    <td>{{ $requisition->product->variance_qty }}</td>
                                    <td>{{ $requisition->price }}</td>
                                    <td>{{ $requisition->technician->fname }} {{ $requisition->technician->mname }}. {{ $requisition->technician->lname }}</td>
                                    @if (auth()->user()->is_admin)
                                        <td>{{ $requisition->customer->name }}</td>
                                    @endif
                                    <td>{{ \Carbon\Carbon::parse($requisition->created_at)->format('M d, Y') }}</td>
                                </tr>
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



@section('specificpagescripts')
<script>
    document.title = "Reports";
</script>
<script>
    function printReport() {
        var printContents = document.getElementById('reportTable').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection