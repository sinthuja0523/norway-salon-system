@extends('layouts.admin-layout')

@section('main')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Time Slots</h5> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Time-slots
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Time-Slots</h5>


                                    </div>
                                    <div class="mb-4">
                                        {{-- <label for="dropdown" class="form-label">Choose a day:</label> --}}
                                        <select class="form-select" id="dropdown">
                                            <option selected>Choose a day:</option>
                                            <option value="1">Moday</option>
                                            <option value="2">Tuesdy</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">saturday</option>
                                            <option value="7">Sunday</option>
                                        </select>
                                    </div>
                                    <div class="mb-4 form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox">
                                        <label class="form-check-label" for="checkbox">Active/Not</label>
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
                                    <th>Day</th>
                                    <th>Active Or Not</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $slots)
                                    <tr>
                                        <td>{{ $slots->day }}</td>
                                        <td>{{ $slots->is_active }}</td>
                                        <td><a href="" class="btn btn-warning">Edit</a>
                                            <a href="" class="btn btn-danger">Delete</a></td>
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
