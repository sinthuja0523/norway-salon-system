@extends('layouts.admin-layout')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        {{-- <div class="d-flex justify-content-between mb-3">
                            <h5>Service</h5>
                            <a href = "" class="btn btn-primary"><i class="fa fa-plus"></i> Add Branch</a>
                        </div --}}
                        <!-- Button trigger modal -->

                        <h5 class="card-title">Services</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Services
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>


                                    </div>
                                    <div class="mb-4">
                                        {{-- <label for="headerTextbox" class="form-label">Enter the service name</label> --}}
                                        <input type="text" class="form-control" id="headerTextbox" placeholder="Enter the service name">
                                    </div>
                                    <div class="mb-4">
                                        <input type="text" class="form-control" id="headerTextbox" placeholder="Enter the Description">
                                    </div>
                                    <div class="mb-4">
                                        <input type="text" class="form-control" id="headerTextbox" placeholder="Enter the price">
                                    </div>
                                   
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
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
                                        <td><a href="" class="btn btn-warning">Edit</a>
                                            <a href="" class="btn btn-danger">Delete</a>
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
@endsection
