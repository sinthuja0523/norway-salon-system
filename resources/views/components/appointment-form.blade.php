<!-- Appointment Form -->
<div class="ctm_appoint_container container-fluid" id="book_appointment">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-secondary p-5">
                        <p class="d-inline-block bg-dark text-primary py-1 px-4">Book an appointment</p>
                        {{-- <h3 class="text-uppercase mb-4">Enter your details</h3> --}}
                        <form method="POST" action="{{ route('book.appointment') }}">
                            @csrf
                            <hr>
                            <h5 class="text-uppercase mb-4">Service Selection</h5>
                            <hr>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <select name="branch" class="form-control bg-transparent ctm_branch"
                                            id="branch">
                                            <option value="">Branch1</option>
                                            <option value="">Branch1</option>
                                            <option value="">Branch1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="service_id"
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Service 1
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"value="2" name="service_id"
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Service 2
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="3" name="service_id"
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Service 3
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control bg-transparent" id="date" name="date"
                                            placeholder="Your Name">
                                        <label for="date">Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="time" class="form-control bg-transparent" id="time" name="time"
                                            placeholder="Your Name">
                                        <label for="time">Time</label>
                                    </div>
                                </div>
                                <hr>
                                <h5 class="text-uppercase mb-4">Personal Details</h5>
                                <hr>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="name" name="name"
                                            placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent" id="email" name="email"
                                            placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="phone_number" name="phone_number"
                                            placeholder="Your mobile number">
                                        <label for="phone_number">Your mobile number</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="address" name="address"
                                            placeholder="Your address">
                                        <label for="address">Your address</label>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-transparent" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
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
