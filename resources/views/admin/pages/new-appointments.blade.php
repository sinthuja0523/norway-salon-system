@extends('layouts.admin-layout')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointments</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>N</b>ame
                                    </th>
                                    <th>Address</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->customer_name }}</td>
                                        <td>{{ $booking->customer_address }}</td>
                                        <td>{{ $booking->booking_date }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>
                                            @if ($booking->status == 'pending')
                                                <button class="btn btn-warning approve_btn"
                                                    data-id="{{ $booking->id }}">Approve</button>
                                                <a href="" data-id="{{ $booking->id }}" class="btn btn-danger decline_btn">Decline</a>
                                            @else
                                                <span class="badge bg-success">Approved</span>
                                            @endif

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

    {{-- scripts --}}

    {{-- JQUERY CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.approve_btn').click(function(event) {
                event.preventDefault();
                var appointment_id = $(this).data('id');
                var button = $(this);
                var row =button.closest('tr');
                console.log(appointment_id)
                $.ajax({
                    url: '/approve',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        appointment_id: appointment_id
                    },
                    success: function(response) {
                        console.log("Response :", response.success)
                        if (response.success) {
                            button.replaceWith('<span class="badge bg-success">Approved</span>');
                            row.find('.decline_btn').hide();
                        }

                    }
                });
            });

            $('.decline_btn').click(function(event) {
                event.preventDefault();
                var appointment_id = $(this).data('id');
                var button = $(this);
                var row =button.closest('tr');
                console.log(appointment_id)
                $.ajax({
                    url: '/decline',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        appointment_id: appointment_id
                    },
                    success: function(response) {
                        console.log("Response :", response.success)
                        if (response.success) {
                            button.replaceWith('<span class="badge bg-danger">Declined</span>');
                            row.find('.approve_btn').hide();
                        }

                    }
                });
            });
        });
    </script>
@endsection
