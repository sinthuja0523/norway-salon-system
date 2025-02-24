@extends('layouts.admin-layout')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <!-- Button trigger modal -->
                        <div class="row" style="display:flex; align-items:center; justify-content:center">
                            <div class="col">
                                <h5 class="card-title">Services</h5>
                            </div>
                            <div class="col"> <button type="button" style="float:right" class="btn btn-sm btn-primary"
                                    data-bs-toggle="modal" id="addServiceBtn" data-bs-target="#serviceModal">
                                    Add Service
                                </button></div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="serviceModalLabel">Add Service</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form id="serviceForm">
                                            @csrf
                                            <input type="hidden" id="service_id" name="service_id" value="">
                                            <div class="mb-4">
                                                <label for="service_name" class="form-label" style="font-weight:700;font-size:0.8em">Name</label>
                                                <input type="text" class="form-control" id="service_name"
                                                    name="service_name" placeholder="Enter the service name">
                                                <span id="serviceNameError" style="color:red;font-size:0.8em"></span><br>
                                            </div>
                                            <div class="mb-4">
                                                <label for="service_description" class="form-label" style="font-weight:700;font-size:0.8em">Description</label>
                                                <input type="text" class="form-control" id="service_description"
                                                    name="service_description" placeholder="Enter the Description">
                                                <span id="serviceDescriptionError" style="color:red;font-size:0.8em"></span><br>
                                            </div>
                                            <div class="mb-4">
                                                <label for="service_price" class="form-label" style="font-weight:700;font-size:0.8em">Price</label>
                                                <input type="number" class="form-control" id="service_price"
                                                    name="service_price" placeholder="Enter the price">
                                                <span id="servicePriceError" style="color:red;font-size:0.8em"></span><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" id="saveService"
                                                    class="btn btn-primary submit">Create</button>
                                                <button type="button" id="updateService"
                                                    class="btn btn-primary update">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>Name</b>
                                    </th>
                                    <th>Service Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $serve)
                                    <tr>
                                        <td>{{ $serve->service_name }}</td>
                                        <td>{{ $serve->service_description }}</td>
                                        <td>{{ $serve->service_price }}</td>
                                        <td><a href="" class="btn btn-warning btn-sm edit"
                                                data-id="{{ $serve->id }}">Edit</a>
                                            <a href="" class="btn btn-danger btn-sm delete"
                                                data-id="{{ $serve->id }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Click add service btn

            $('#addServiceBtn').click(function(e) {
                e.preventDefault();
                $('#updateService').hide();
                $('#serviceForm')[0].reset();

            });

            // Create Service

            $('#saveService').click(function(e) {
                e.preventDefault();
                $('#updateService').hide();

                let service_name = $('#service_name').val();
                let service_description = $('#service_description').val();
                let service_price = $('#service_price').val();

                // Validation

                let serviceName = $('#service_name').val().trim();
                let serviceDescription = $('#service_description').val().trim();
                let servicePrice = $('#service_price').val().trim();

                if (serviceName.length < 3) {
                    $('#serviceNameError').text('Name must be at least 3 characters.');
                    return;
                }
                if (service_description.length < 5) {
                    $('#serviceDescriptionError').text('Description must be at least 5 characters long.');
                    return;
                }
                if ($('#service_price').val() <= 0) {
                    $('#servicePriceError').text('Price cannot be zero.');
                    return;
                }

                // AJAX request
                $.ajax({
                    url: '/service-add',
                    method: "POST",
                    data: {
                        service_name: service_name,
                        service_description: service_description,
                        service_price: service_price
                    },
                    success: function(response) {
                        $('#serviceModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Debugging
                        alert('Error adding service!');
                    }
                });
            });

            // Fetch service record

            $(document).on('click', '.edit', function(event) {
                event.preventDefault();
                $('#updateService').show();
                $('#saveService').hide();
                let id = $(this).data('id');
                $('#service_id').val(id);

                $.ajax({
                    method: "GET",
                    url: `/service-edit/${id}`,
                    data: {
                        service_id: id
                    },
                    success: function(response) {
                        console.log(response.data.service_name)
                        $('#service_name').val(response.data.service_name);
                        $('#service_description').val(response.data.service_description);
                        $('#service_price').val(response.data.service_price);
                        $('#serviceModal').modal('show');

                    }
                });
            });

            // Update Service

            $(document).on('click', '.update', function(event) {
                event.preventDefault();

                console.log('clicked');
                let id = $('#service_id').val();
                console.log(id)
                let method = 'POST';
                let service_name = $('#service_name').val();
                let service_description = $('#service_description').val();
                let service_price = $('#service_price').val();

                // Validation

                let serviceName = $('#service_name').val().trim();
                let serviceDescription = $('#service_description').val().trim();
                let servicePrice = $('#service_price').val().trim();

                // Client-side validation
                if (serviceName.length < 3) {
                    $('#serviceNameError').text('Name must be at least 3 characters.');
                    return;
                }
                if (service_description.length < 5) {
                    $('#serviceDescriptionError').text('Description must be at least 5 characters long.');
                    return;
                }
                if ($('#service_price').val() <= 0) {
                    $('#servicePriceError').text('Price cannot be zero.');
                    return;
                }

                $.ajax({
                    url: `/service-update/${id}`,
                    method: 'POST',
                    data: {
                        service_name: service_name,
                        service_description: service_description,
                        service_price: service_price,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function() {
                        $('#service_id').val('');
                        $('#updateService').val('Updated');
                        $('#serviceModal').modal('hide');
                        $('#updateService').val('Update');
                        $('#serviceForm')[0].reset();
                        location.reload();
                    }
                });
            });

        });

        // Delte Service

        $(document).on('click', '.delete', function(event) {
            event.preventDefault();
            let id = $(this).data('id');

            if (confirm('Are you sure you want to delete this service?')) {
                $.ajax({
                    url: `/service-delete/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function() {
                        location.reload();
                    }
                });
            }
        });
    </script>
@endsection
