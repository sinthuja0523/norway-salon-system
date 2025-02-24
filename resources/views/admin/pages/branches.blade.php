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
                                <h5 class="card-title">Branches</h5>
                            </div>
                            <div class="col"> <button type="button" style="float:right" class="btn btn-sm btn-primary"
                                    data-bs-toggle="modal" id="addBranchBtn" data-bs-target="#branchModal">
                                    Add Branch
                                </button></div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="branchModal" tabindex="-1" aria-labelledby="branchModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="branchModalLabel">Add Branch</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form id="branchForm">
                                            @csrf
                                            <input type="hidden" id="branch_id" name="branch_id" value="">
                                            <div class="mb-4">
                                                <label for="branch_name" class="form-label" style="font-weight:700;font-size:0.8em">Name</label>
                                                <input type="text" class="form-control" id="branch_name"
                                                    name="branch_name" placeholder="Enter the branch name">
                                                <span id="branchNameError" style="color:red;font-size:0.8em"></span><br>
                                            </div>
                                            <div class="mb-4">
                                                <label for="branch_address" class="form-label" style="font-weight:700;font-size:0.8em">Address</label>
                                                <input type="text" class="form-control" id="branch_address"
                                                    name="branch_address" placeholder="Enter the address">
                                                <span id="branchAddressError" style="color:red;font-size:0.8em"></span><br>
                                            </div>
                                            <div class="mb-4">
                                                <label for="office_number" class="form-label" style="font-weight:700;font-size:0.8em">Office Number</label>
                                                <input type="number" class="form-control" id="office_number"
                                                    name="office_number" placeholder="Enter the number">
                                                <span id="officeNumberError" style="color:red;font-size:0.8em"></span><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" id="saveBranch"
                                                    class="btn btn-primary submit">Create</button>
                                                <button type="button" id="updateBranch"
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
                                    <th>Branch Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $serve)
                                    <tr>
                                        <td>{{ $serve->branch_name }}</td>
                                        <td>{{ $serve->branch_address }}</td>
                                        <td>{{ $serve->office_number }}</td>
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

            // Click add branch btn

            $('#addBranchBtn').click(function(e) {
                e.preventDefault();
                $('#updateBranch').hide();
                $('#branchForm')[0].reset();

            });

            // Create Branch

            $('#saveBranch').click(function(e) {
                e.preventDefault();
                $('#updateBranch').hide();

                let branch_name = $('#branch_name').val();
                let branch_address = $('#branch_address').val();
                let office_number = $('#office_number').val();

                // Validation

                let branchName = $('#branch_name').val().trim();
                let branchAddress = $('#branch_address').val().trim();
                let officeNumber = $('#office_number').val().trim();

                if (branchName.length < 3) {
                    $('#branchNameError').text('Name must be at least 3 characters.');
                    return;
                }
                if (branch_address.length < 5) {
                    $('#branchAddressError').text('Adress must be at least 5 characters long.');
                    return;
                }
                if (officeNumber.length < 10) {
                    $('#officeNumberError').text('Number must be greater than 9 digits.');
                    return;
                }

                // AJAX request
                $.ajax({
                    url: '/branch-add',
                    method: "POST",
                    data: {
                        branch_name: branch_name,
                        branch_address: branch_address,
                        office_number: office_number
                    },
                    success: function(response) {
                        $('#branchModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Debugging
                        alert('Error adding branch!');
                    }
                });
            });

            // Fetch branch record

            $(document).on('click', '.edit', function(event) {
                event.preventDefault();
                $('#updateBranch').show();
                $('#saveBranch').hide();
                let id = $(this).data('id');
                $('#branch_id').val(id);

                $.ajax({
                    method: "GET",
                    url: `/branch-edit/${id}`,
                    data: {
                        branch_id: id
                    },
                    success: function(response) {
                        console.log(response.data.branch_name)
                        $('#branch_name').val(response.data.branch_name);
                        $('#branch_address').val(response.data.branch_address);
                        $('#office_number').val(response.data.office_number);
                        $('#branchModal').modal('show');

                    }
                });
            });

            // Update Branch

            $(document).on('click', '.update', function(event) {
                event.preventDefault();

                console.log('clicked');
                let id = $('#branch_id').val();
                console.log(id)
                let method = 'POST';
                let branch_name = $('#branch_name').val();
                let branch_address = $('#branch_address').val();
                let office_number = $('#office_number').val();

                // Validation

                let branchName = $('#branch_name').val().trim();
                let branchAddress = $('#branch_address').val().trim();
                let officeNumber = $('#office_number').val().trim();

                // Client-side validation
                if (branchName.length < 3) {
                    $('#branchNameError').text('Name must be at least 3 characters.');
                    return;
                }
                if (branch_address.length < 5) {
                    $('#branchAddressError').text('Description must be at least 5 characters long.');
                    return;
                }
                if ($('#office_number').val() <= 0) {
                    $('#officeNumberError').text('Price cannot be zero.');
                    return;
                }

                $.ajax({
                    url: `/branch-update/${id}`,
                    method: 'POST',
                    data: {
                        branch_name: branch_name,
                        branch_address: branch_address,
                        office_number: office_number,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function() {
                        $('#branch_id').val('');
                        $('#updateBranch').val('Updated');
                        $('#branchModal').modal('hide');
                        $('#updateBranch').val('Update');
                        $('#branchForm')[0].reset();
                        location.reload();
                    }
                });
            });

        });

        // Delte Branch

        $(document).on('click', '.delete', function(event) {
            event.preventDefault();
            let id = $(this).data('id');

            if (confirm('Are you sure you want to delete this branch?')) {
                $.ajax({
                    url: `/branch-delete/${id}`,
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
