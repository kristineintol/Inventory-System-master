@extends('dashboard.body.main')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto my-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Inventory
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <!-- Video element for camera feed -->
                    <div class="col-auto my-4">
                        <video id="camera-feed" style="width: 100%; max-width: 320px;"></video>
                    </div>
                </div>
                <div class="col-auto my-4">
                    @if (auth()->user()->is_admin)
                        <button  id="startScanButton" class="btn btn-success add-list my-1" style="margin-right: 8px;"><i class="fas fa-barcode me-3"></i> Scan Barcode</button>
                        <a href="{{ route('products.create') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-plus me-3"></i>Add</a>
                        <!-- Button to trigger barcode scanning -->
                    @endif
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Inventory</li>
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
                    <form action="{{ route('products.index') }}" method="GET">
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
                                <label class="control-label col-sm-3" for="search">Search:</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search product" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20 text-white"></i></button>
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
                                    <th scope="col">SLOC Code</th>
                                    <th scope="col">Material Code</th>
                                    <th scope="col">SLOC Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">UOM</th>
                                    <th scope="col">SAP Quantity</th>
                                    <th scope="col">AC Quantity</th>
                                    <th scope="col">Rec Quantity</th>
                                    <th scope="col">Variance Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $rowNumber = ($products->currentPage() - 1) * $products->perPage() + 1;
                                @endphp
                                @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $rowNumber }}</th>
                                    <td>{{ $product->sloc_code }}</td>
                                    <td>{{ $product->material_code }}</td>
                                    <td>{{ $product->sloc_name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->uom }}</td>
                                    <td>{{ $product->sap_qty }}</td>
                                    <td>{{ $product->ac_qty }}</td>
                                    <td>{{ $product->rec_qty }}</td>
                                    <td>{{ $product->variance_qty }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            @if (auth()->user()->is_admin)
                                                <a href="#" class="btn btn-outline-info btn-sm mx-1 generate-barcode-button" data-product-id="{{ $product->id }}"><i class="fa-solid fa-qrcode"></i></a>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('requisitions.createSelected', $product->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fa-solid fa-list"></i></a>
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

                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->

<!-- QR Code Modal -->
<div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrCodeModalLabel">Bar Code for Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <svg id="barcodeImage"></svg>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>


<script>
    // Function to generate barcode
    function generateBarcode(productId) {
        const barcodeDiv = $('#barcodeImage');
        barcodeDiv.empty(); // Clear any existing barcode

        // Generate the barcode using JsBarcode
        JsBarcode(barcodeDiv[0], productId, {
            format: "CODE128", // You can change the format as needed
            width: 2,
            height: 40,
        });

        // Show the modal
        $('#barcodeModal').modal('show');
    }


    function getRootUrl(url) {
        const urlObj = new URL(url);
        return urlObj.hostname;
    }

    const currentURL = window.location.href;
    const rootUrl = getRootUrl(currentURL);

    // Add a click event listener to buttons with the specified class using jQuery
    $(document).ready(function () {
        $('.generate-barcode-button').click(function (e) {
            e.preventDefault();
            // const productId = currentURL + "/requisitions/createselected/" + $(this).data('product-id');
            const productId = $(this).data('product-id');
            generateBarcode(productId);
        });
    });

    function initializeBarcodeScanner() {
    const videoElement = document.getElementById('camera-feed');

    // const req = rootUrl + "/requisitions/createselected/" + 1;
    // window.open(req, "_self");
    

    // Check if the browser supports getUserMedia
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Access the user's camera
        navigator.mediaDevices
            .getUserMedia({ video: true })
            .then(function (stream) {
                
                // Assign the camera feed to the video element
                videoElement.srcObject = stream;
                videoElement.play();

                // Initialize Quagga.js
                Quagga.init(
                    {
                        inputStream: {
                            name: 'Live',
                            type: 'LiveStream',
                            target: videoElement,
                        },
                        decoder: {
                            readers: ['ean_reader', 'code_128_reader'],
                        },
                    },
                    function (err) {
                        if (err) {
                            console.error('Error initializing Quagga:', err);
                            return;
                        }

                        // Start Quagga.js barcode detection
                        Quagga.start();

                        // Add an event listener for barcode detection
                        Quagga.onDetected(function (result) {
                            // The detected barcode result is available in the `result` object
                            const barcodeData = result.codeResult.code;
                            alert('Barcode detected: ' + barcodeData);
                            // const req = currentURL + "/requisitions/createselected/" + barcodeData;
                            window.location.href = "https://" + rootUrl + "/requisitions/createselected/" + barcodeData;

                            // You can perform further actions with the barcode data, such as sending it to the server.
                        });
                    }
                );
            })
            .catch(function (error) {
                console.error('Error accessing the camera:', error);
            });
    } else {
        console.error('getUserMedia is not supported in this browser.');
    }
}

// Call the function to initialize the barcode scanner when the page loads
document.addEventListener('DOMContentLoaded', initializeBarcodeScanner);

</script>


@endsection
