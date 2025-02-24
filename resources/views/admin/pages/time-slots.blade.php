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
                                <h5 class="card-title">Time Management</h5>
                            </div>
                            <div class="col"> <button type="button" style="float:right" class="btn btn-sm btn-primary"
                                    data-bs-toggle="modal" id="addTimeBtn" data-bs-target="#timeModal">
                                    Add Time
                                </button></div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="timeModal" tabindex="-1" aria-labelledby="timeModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="timeModalLabel">Add Time</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form id="timeForm">
                                            @csrf
                                            <input type="hidden" id="time_id" name="time_id" value="">
                                            <div class="mb-4">
                                                <label for="time_value" class="form-label" style="font-weight:700;font-size:0.8em">Time</label>
                                                <input type="time" class="form-control" id="time_value"
                                                    name="time_value" placeholder="Enter the time name">
                                                <span id="timeValueError" style="color:red;font-size:0.8em"></span><br>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" id="saveTime"
                                                    class="btn btn-primary submit">Create</button>
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($times as $time)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($time->time)->format('h:i A') }}</td>
                                        <td><div class="form-check form-switch ">
                                            <input class="form-check-input toggle-status" type="checkbox" data-id="{{ $time->id }}" {{ $time->is_active ? 'checked' : '' }} id="flexSwitchCheckChecked">

                                          </div></td>
                                        <td>
                                            <a href="" class="btn btn-danger btn-sm delete"
                                                data-id="{{ $time->id }}">Delete</a>
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

            // Click add time btn

            $('#addTimeBtn').click(function(e) {
                e.preventDefault();
                $('#updateTime').hide();
                $('#timeForm')[0].reset();

            });

            // Create Time

            $('#saveTime').click(function(e) {
                e.preventDefault();
                $('#updateTime').hide();

                let time_value = $('#time_value').val();

                // Validation

                let timeValue = $('#time_value').val().trim();

                if (timeValue.length == null || timeValue.length == undefined ) {
                    $('#timeValueError').text('Enter a valid time.');
                    return;
                }

                // AJAX request
                $.ajax({
                    url: '/time-add',
                    method: "POST",
                    data: {
                        time_value: time_value,
                    },
                    success: function(response) {
                        $('#timeModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Debugging
                        alert('Error adding time!');
                    }
                });
            });

            // Fetch time record



            // Update Time

            $('.toggle-status').change(function () {
            let id = $(this).data('id');
            let status = $(this).prop('checked') ? 1 : 0;
                console.log(id,status)
            $.ajax({
                url: "/time-update",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status: status
                },
                success: function (response) {
                    alert(response.message);
                },
                error: function (xhr) {
                    alert('Error updating status');
                }
            });
        });

        });

        // Delte Time

        $(document).on('click', '.delete', function(event) {
            event.preventDefault();
            let id = $(this).data('id');

            if (confirm('Are you sure you want to delete this time?')) {
                $.ajax({
                    url: `/time-delete/${id}`,
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
