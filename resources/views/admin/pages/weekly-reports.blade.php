@extends('layouts.admin-layout')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Weekly Report</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>Branch Name</b>
                                    </th>
                                    <th>Customer_Id</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Appointment Date</th>
                                    <th>Services</th>
                                    <th>Barber Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->customer_name }}</td>
                                        <td>{{ $booking->customer_address }}</td>
                                        <td>{{ $booking->booking_date }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td><a href="" class="btn btn-warning">Approve</a>
                                            <a href="" class="btn btn-danger">Decline</a></td>
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
@endsection
