<!-- Appointment Form -->
<div class="ctm_appoint_container container-fluid" id="book_appointment">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-secondary p-5">
                        <p class="d-inline-block bg-dark text-primary py-1 px-4">Book an appointment</p>
                        {{-- <h3 class="text-uppercase mb-4">Enter your details</h3> --}}
                        <form id="appointmentForm">
                            @csrf
                            <hr>
                            <h5 class="text-uppercase mb-4">Service Selection</h5>
                            <hr>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <select name="branch" class="form-control bg-transparent ctm_branch" id="branch">
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        @foreach ($services as $service)
                                            <div class="form-check">
                                                <input class="form-check-input service-checkbox" type="checkbox"
                                                       name="service_id[]" value="{{ $service->id }}" id="service_{{ $service->id }}">
                                                <label class="form-check-label" for="service_{{ $service->id }}">
                                                    {{ $service->service_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control bg-transparent" id="date" name="date">
                                        <label for="date">Date</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="time_slot" class="form-control bg-transparent ctm_branch" id="time_slot">
                                            @foreach ($time_slots as $time_slot)
                                                <option value="{{ \Carbon\Carbon::parse($time_slot->time)->format('h:i A') }}">{{ \Carbon\Carbon::parse($time_slot->time)->format('h:i A') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <h5 class="text-uppercase mb-4">Personal Details</h5>
                                <hr>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="name" name="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent" id="email" name="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="phone_number" name="phone_number" placeholder="Your mobile number">
                                        <label for="phone_number">Your mobile number</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="address" name="address" placeholder="Your address">
                                        <label for="address">Your address</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button id="submitAppointment" class="btn btn-primary w-100 py-3" type="button">Book Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <img class="ctm_appoint_image" src="{{ asset('assets/img/open.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>


<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#submitAppointment').click(function(e) {
            e.preventDefault();

            let formData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                branch: $('#branch').val(),
                date: $('#date').val(),
                time_slot: $('#time_slot').val(),
                name: $('#name').val(),
                email: $('#email').val(),
                phone_number: $('#phone_number').val(),
                address: $('#address').val(),
                service_ids: []
            };

            $('.service-checkbox:checked').each(function() {
                console.log('test')
                formData.service_ids.push($(this).val());
            });

            // AJAX Request
            $.ajax({
                url: '/book-appointment',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    formData: formData,
                },
                success: function (response) {
                    // alert(response.message);
                    $('#appointmentForm')[0].reset(); // Reset form on success
                },
                error: function (xhr) {
                    // alert('Error booking appointment.');
                }
            });
        });
    });
</script>
