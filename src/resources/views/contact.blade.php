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
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-title">CONTACT<br>US</div>
                <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                <a href="/contact" class="hero-btn">More info</a>
            </div>
        </section>
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

        @include('layouts.footer')
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
<style>
    /* Fonts */
    h2.section-title,
    h3.section-title,
    h4.hot-topic-title,
    h6.news-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    p.hot-topic-desc,
    small,
    a.read-more-link {
        font-family: 'Poppins', sans-serif;
    }

    /* HOT TOPIC */
    .hot-topic-img-wrapper {
        height: 500px;
        /* diperbesar dari 400px */
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .hot-topic-img-wrapper:hover {
        transform: scale(1.03);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.35);
    }

    .hot-topic-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 1.25rem;
        transition: transform 0.3s ease;
    }

    .hot-topic-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 2rem;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.75), transparent);
        border-bottom-left-radius: 1.25rem;
        border-bottom-right-radius: 1.25rem;
    }

    .hot-topic-title {
        font-size: 2rem;
        /* lebih besar */
        margin-bottom: 0.5rem;
        color: #fff;
    }

    .hot-topic-meta {
        font-size: 1rem;
        color: #ddd;
    }

    .hot-topic-desc {
        font-size: 1.2rem;
        line-height: 1.6;
        color: #eee;
        margin-top: 0.5rem;
    }

    .btn-read-more {
        margin-top: 1rem;
        font-size: 1.1rem;
        padding: 0.75rem 1.75rem;
    }

    /* LATEST NEWS */
    .card {
        border-radius: 1rem;
        transition: box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .news-img {
        height: 250px;
        /* diperbesar */
        width: 100%;
        object-fit: cover;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        transition: transform 0.3s ease;
    }

    .hover-shadow:hover .news-img {
        transform: scale(1.05);
    }

    .card-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .news-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #222;
        flex-grow: 1;
    }

    .news-meta {
        font-size: 0.95rem;
        color: #777;
        margin-top: auto;
        font-style: italic;
    }

    /* RESPONSIVE - Skala turun bertahap */
    @media (max-width: 992px) {
        .hot-topic-img-wrapper {
            height: 400px;
        }

        .news-img {
            height: 200px;
        }

        .news-title {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 768px) {
        .hot-topic-img-wrapper {
            height: 300px;
        }

        .news-img {
            height: 160px;
        }

        .hot-topic-title {
            font-size: 1.5rem;
        }

        .hot-topic-desc {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .news-img {
            height: 140px;
        }

        .news-title {
            font-size: 1rem;
        }
    }

    /* ==== BUTTON "READ MORE" ==== */
    .btn-read-more {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 30px;
        background: linear-gradient(135deg, #0d6efd, #0056b3);
        color: #fff;
        font-weight: 600;
        font-size: 1.05rem;
        border: none;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        gap: 0.5rem;
    }

    .btn-read-more:hover {
        background: linear-gradient(135deg, #0046b3, #003580);
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .btn-arrow {
        transition: transform 0.3s ease;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .btn-read-more:hover .btn-arrow {
        transform: translateX(6px);
    }


    /* content   */
    body,
    html {
        margin: 0;
        padding: 0;
        font-family: 'Helvetica Neue', sans-serif;
    }

    .hero-section {
        position: relative;
        background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.2)),
            url('/images/hero.jpg') no-repeat center center/cover;
        height: 80vh;
        color: white;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        overflow: hidden;
    }

    .hero-content {
        width: 100%;
        max-width: 1140px;
        padding-left: 400px;
        padding-right: 30px;
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 1.2s ease forwards;
        animation-delay: 0.3s;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    .hero-title {
        font-size: 80px;
        /* besar dan dominan */
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 20px;
        letter-spacing: 30px;
        /* jarak antar huruf */
        text-transform: uppercase;
    }

    .hero-desc {
        font-size: 16px;
        margin-bottom: 28px;
        line-height: 1.6;
        color: #ddd;
        max-width: 500px;
    }

    .hero-btn {
        display: inline-block;
        padding: 12px 30px;
        background-color: transparent;
        border: 2px solid white;
        color: white;
        text-decoration: none;
        font-weight: 600;
        border-radius: 25px;
        transition: all 0.3s ease-in-out;
        font-size: 14px;
        letter-spacing: 1.5px;
    }

    .hero-btn:hover {
        background-color: white;
        color: black;
    }
</style>

</html>
