<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')

    @section('title', 'Contact Us - oneVision')

    @section('content')
        <div class="container py-5">
            <h1 class="mb-4">Contact Us</h1>

            <div class="row">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Send us a Message</h5>
                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Contact Information</h5>
                            <p><i class="fas fa-map-marker-alt me-2"></i> Jl. PNP Tercinta</p>
                            <p><i class="fas fa-phone me-2"></i> +62 123 4567 890</p>
                            <p><i class="fas fa-envelope me-2"></i> info@agile-d1.com</p>
                            <p><i class="fas fa-clock me-2"></i> Open daily: 08:00 - 17:00</p>

                            <h5 class="mt-4">Follow Us</h5>
                            <div class="social-links">
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="btn btn-outline-info me-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-outline-danger me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="btn btn-outline-success"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h2 class="mb-4">Our Location</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="ratio ratio-16x9">
                            <!-- Replace with your actual Google Maps embed code -->
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15955.309681576033!2d100.4237422!3d-1.0524651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4a594047f51ff%3A0xf851098b76ef9461!2sWisata%20Air%20Terjun%20Lubuk%20Hitam%20Lestari!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                                allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h2 class="mb-4">Frequently Asked Questions</h2>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What are your operating hours?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We are open daily from 8:00 AM to 5:00 PM. However, some specific attractions or services
                                might
                                have different operating hours. Please check the specific service page for more details.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Do I need to book a tour guide in advance?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, we recommend booking a tour guide at least 2-3 days in advance, especially during peak
                                seasons. This ensures availability and allows us to match you with the most suitable guide
                                for
                                your needs.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How can I purchase honey and UMKM products?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can purchase our honey and UMKM products directly from our website by visiting the
                                respective product pages. We also have a physical store at our location where you can buy
                                these
                                products during your visit.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            // Additional contact page specific scripts can go here
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Contact page loaded');
            });
        </script>
    @endsection

</body>

</html>
