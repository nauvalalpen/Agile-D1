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
                <div class="hero-title">HUBUNGI<br>KAMI</div>
                <div class="hero-desc">Ada pertanyaan, kritik, atau saran tentang Wisata Air Terjun Lubuk Hitam?
                    Jangan ragu untuk menghubungi kami. Kami siap membantu Anda!</div>
                <a href="#contact-grid" class="hero-btn">Hubungi Sekarang</a>
            </div>
        </section>

        <!-- Contact Section - Fixed styling to match index.blade.php -->
        <div id="contact-grid" class="beritas-container">
            <section style="padding: 6rem 0; background: #ffffff;">

                <div class="container">
                    <!-- Section Header -->
                    <div class="text-center mb-5 scroll-reveal">
                        <h2
                            style="font-size: 3rem; font-weight: 800; color: #1a202c; margin-bottom: 1rem; background: linear-gradient(135deg, #0a1f0f 0%, #1a3d2e 30%, #2d5a3d 70%, #228B22 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Hubungi Kami
                        </h2>
                        <p style="font-size: 1.2rem; color: #64748b; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                            Kami siap membantu merencanakan kunjungan terbaik Anda ke Air Terjun Lubuk Hitam
                        </p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; margin-bottom: 4rem;">
                        <!-- Contact Form -->
                        <div class="glass-card scroll-reveal" id="contact-form">
                            <div style="text-align: center; margin-bottom: 2rem;">
                                <h3
                                    style="font-size: 1.8rem; font-weight: 800; color: #1a202c; margin-bottom: 0.5rem; background: linear-gradient(135deg, #0a1f0f 0%, #228B22 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                    Kirim Pesan
                                </h3>
                                <p style="color: #64748b; line-height: 1.6;">
                                    Bagikan pertanyaan atau saran Anda kepada kami
                                </p>
                            </div>

                            <form id="contactForm">
                                @csrf
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                    <div>
                                        <input type="text" name="name" required
                                            style="width: 100%; padding: 15px 20px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 15px; color: #1a202c; font-size: 1rem; transition: all 0.3s ease; font-family: inherit;"
                                            placeholder="Nama Lengkap">
                                    </div>
                                    <div>
                                        <input type="email" name="email" required
                                            style="width: 100%; padding: 15px 20px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 15px; color: #1a202c; font-size: 1rem; transition: all 0.3s ease; font-family: inherit;"
                                            placeholder="Email">
                                    </div>
                                </div>

                                <div style="margin-bottom: 1rem;">
                                    <select name="subject" required
                                        style="width: 100%; padding: 15px 20px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 15px; color: #1a202c; font-size: 1rem; transition: all 0.3s ease; font-family: inherit;">
                                        <option value="">Pilih subjek pesan</option>
                                        <option value="informasi">Informasi Umum</option>
                                        <option value="reservasi">Reservasi & Booking</option>
                                        <option value="fasilitas">Fasilitas & Layanan</option>
                                        <option value="keluhan">Keluhan</option>
                                        <option value="saran">Saran & Masukan</option>
                                    </select>
                                </div>

                                <div style="margin-bottom: 1.5rem;">
                                    <textarea name="message" rows="4" required
                                        style="width: 100%; padding: 15px 20px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 15px; color: #1a202c; font-size: 1rem; transition: all 0.3s ease; font-family: inherit; resize: vertical;"
                                        placeholder="Tulis pesan Anda di sini..."></textarea>
                                </div>

                                <button type="submit"
                                    style="width: 100%; padding: 15px 30px; background: linear-gradient(135deg, #0a1f0f 0%, #1a3d2e 30%, #2d5a3d 70%, #228B22 100%); color: white; border: none; border-radius: 50px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(34, 139, 34, 0.3); display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                    <i class="fas fa-paper-plane"></i>
                                    Kirim Pesan
                                </button>
                            </form>
                        </div>

                        <!-- Contact Info -->
                        <div class="glass-card scroll-reveal" id="contact-info">
                            <div style="text-align: center; margin-bottom: 2rem;">

                                <h3
                                    style="font-size: 1.8rem; font-weight: 800; color: #1a202c; margin-bottom: 0.5rem; background: linear-gradient(135deg, #0a1f0f 0%, #228B22 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                    Informasi Kontak
                                </h3>
                                <p style="color: #64748b; line-height: 1.6;">
                                    Hubungi kami melalui berbagai cara
                                </p>
                            </div>

                            <div style="display: grid; gap: 1.5rem;">
                                <div
                                    style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem; background: #f8fafc; border-radius: 15px; border-left: 4px solid #228B22;">
                                    <div
                                        style="width: 50px; height: 50px; background: linear-gradient(135deg, #0a1f0f 0%, #228B22 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0; font-size: 1.1rem; font-weight: 600; color: #1a202c;">Lokasi
                                        </h4>
                                        <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Air Terjun Lubuk
                                            Hitam<br>Padang Panjang, Sumatera Barat</p>
                                    </div>
                                </div>

                                <div
                                    style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem; background: #f8fafc; border-radius: 15px; border-left: 4px solid #228B22;">
                                    <div
                                        style="width: 50px; height: 50px; background: linear-gradient(135deg, #0a1f0f 0%, #228B22 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0; font-size: 1.1rem; font-weight: 600; color: #1a202c;">Telepon
                                        </h4>
                                        <p style="margin: 0; color: #64748b; font-size: 0.95rem;">+62
                                            812-3456-7890<br>0751-123-4567</p>
                                    </div>
                                </div>

                                <div
                                    style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem; background: #f8fafc; border-radius: 15px; border-left: 4px solid #228B22;">
                                    <div
                                        style="width: 50px; height: 50px; background: linear-gradient(135deg, #0a1f0f 0%, #228B22 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0; font-size: 1.1rem; font-weight: 600; color: #1a202c;">Email
                                        </h4>
                                        <p style="margin: 0; color: #64748b; font-size: 0.95rem;">
                                            info@lubukhitam.com<br>admin@lubukhitam.com</p>
                                    </div>
                                </div>

                                <div
                                    style="display: flex; align-items: center; gap: 1rem; padding: 1.5rem; background: #f8fafc; border-radius: 15px; border-left: 4px solid #228B22;">
                                    <div
                                        style="width: 50px; height: 50px; background: linear-gradient(135deg, #0a1f0f 0%, #228B22 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0; font-size: 1.1rem; font-weight: 600; color: #1a202c;">Jam
                                            Operasional</h4>
                                        <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Senin - Minggu<br>08:00 -
                                            17:00 WIB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media -->
                            <div style="margin-top: 2rem; text-align: center;">
                                <h4 style="margin-bottom: 1rem; font-size: 1.1rem; font-weight: 600; color: #1a202c;">Ikuti
                                    Kami</h4>
                                <div style="display: flex; justify-content: center; gap: 1rem;">
                                    <a href="#"
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #3b5998, #8b9dc3); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(59, 89, 152, 0.3);">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#"
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #e1306c, #fd1d1d); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(225, 48, 108, 0.3);">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#"
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #1da1f2, #0e71c8); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(29, 161, 242, 0.3);">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#"
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #ff0000, #cc0000); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="glass-card scroll-reveal">
                        <div style="text-align: center; margin-bottom: 2rem;">

                            <h3
                                style="font-size: 1.8rem; font-weight: 800; color: #1a202c; margin-bottom: 0.5rem; background: linear-gradient(135deg, #0a1f0f 0%, #228B22 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                Lokasi Kami
                            </h3>
                            <p style="color: #64748b; line-height: 1.6;">
                                Temukan kami di peta dan rencanakan kunjungan Anda
                            </p>
                        </div>

                        <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15955.309681576033!2d100.4237422!3d-1.0524651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4a594047f51ff%3A0xf851098b76ef9461!2sWisata%20Air%20Terjun%20Lubuk%20Hitam%20Lestari!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </section>
            @include('layouts.footer')
            <!-- CSS Styles matching index.blade.php -->
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                    background-color: #f8f9fa;
                }

                /* === 1. HERO SECTION === */
                .hero-section {
                    position: relative;
                    background: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)),
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
                    padding-left: 350px;
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
                    font-weight: 900;
                    line-height: 1.1;
                    margin-bottom: 20px;
                    letter-spacing: 30px;
                    text-transform: uppercase;
                    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
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
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
                }

                /* For mobile phones */
                @media (max-width: 576px) {
                    .hero-section {
                        height: 65vh;
                        /* Reduce height for small screens */
                    }

                    .hero-content {
                        padding: 0 1rem;
                    }

                    .hero-title {
                        font-size: 36px;
                        letter-spacing: 5px;
                    }
                }



                /* Glass Card - exact match from index.blade.php */
                .glass-card {
                    background: rgba(255, 255, 255, 0.95);
                    backdrop-filter: blur(20px);
                    -webkit-backdrop-filter: blur(20px);
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    border-radius: 25px;
                    padding: 2.5rem;
                    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.1);
                    transition: all 0.3s ease;
                }

                .glass-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 35px 100px rgba(0, 0, 0, 0.15);
                }

                /* Button Glass - exact match from index.blade.php */
                .btn-glass {
                    padding: 15px 30px;
                    border: none;
                    border-radius: 50px;
                    font-weight: 600;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    backdrop-filter: blur(20px);
                    -webkit-backdrop-filter: blur(20px);
                    position: relative;
                    overflow: hidden;
                    cursor: pointer;
                }

                .btn-glass-primary {
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    color: white;
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                }

                .btn-glass-primary:hover {
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.2));
                    transform: translateY(-2px);
                    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
                    color: white;
                }

                .btn-glass-secondary {
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    color: rgba(255, 255, 255, 0.9);
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                }

                .btn-glass-secondary:hover {
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
                    transform: translateY(-2px);
                    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
                    color: white;
                }

                /* Animations - exact match from index.blade.php */
                @keyframes float {

                    0%,
                    100% {
                        transform: translateY(0px) rotate(0deg);
                    }

                    50% {
                        transform: translateY(-20px) rotate(5deg);
                    }
                }

                @keyframes floatUpDown {

                    0%,
                    100% {
                        transform: translateY(0px);
                    }

                    50% {
                        transform: translateY(-15px);
                    }
                }

                /* Scroll Reveal - exact match from index.blade.php */
                .scroll-reveal {
                    opacity: 0;
                    transform: translateY(50px);
                    transition: all 0.8s ease;
                }

                .scroll-reveal.revealed {
                    opacity: 1;
                    transform: translateY(0);
                }

                /* Form Styles */
                input:focus,
                select:focus,
                textarea:focus {
                    outline: none;
                    border-color: #228B22 !important;
                    box-shadow: 0 0 0 3px rgba(34, 139, 34, 0.1) !important;
                }

                button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 15px 40px rgba(34, 139, 34, 0.4) !important;
                }

                /* Social Media Hover Effects */
                a[href="#"]:hover {
                    transform: translateY(-3px) scale(1.05);
                }

                /* Responsive Design */
                @media (max-width: 768px) {
                    div[style*="grid-template-columns: 1fr 1fr"] {
                        display: block !important;
                    }

                    .glass-card {
                        margin-bottom: 2rem;
                        padding: 1.5rem;
                    }

                    div[style*="grid-template-columns: 1fr 1fr"]:first-child>div {
                        margin-bottom: 1rem;
                    }

                    h2[style*="font-size: 3rem"] {
                        font-size: 2rem !important;
                    }

                    h3[style*="font-size: 1.8rem"] {
                        font-size: 1.5rem !important;
                    }
                }

                @media (max-width: 576px) {
                    .glass-card {
                        padding: 1rem;
                    }

                    div[style*="font-size: 4rem"] {
                        font-size: 3rem !important;
                    }

                    div[style*="display: flex; justify-content: center; gap: 1rem;"] {
                        gap: 0.5rem !important;
                    }
                }
            </style>

            <!-- JavaScript -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Scroll Reveal Animation - matching index.blade.php
                    const observerOptions = {
                        threshold: 0.1,
                        rootMargin: '0px 0px -50px 0px'
                    };

                    const observer = new IntersectionObserver(function(entries) {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('revealed');
                            }
                        });
                    }, observerOptions);

                    document.querySelectorAll('.scroll-reveal').forEach(el => {
                        observer.observe(el);
                    });

                    // Contact Form Submission
                    const contactForm = document.getElementById('contactForm');
                    if (contactForm) {
                        contactForm.addEventListener('submit', function(e) {
                            e.preventDefault();

                            const submitBtn = this.querySelector('button[type="submit"]');
                            const originalHTML = submitBtn.innerHTML;

                            // Loading state
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                            submitBtn.disabled = true;

                            // Simulate form submission
                            setTimeout(() => {
                                this.reset();
                                submitBtn.innerHTML = '<i class="fas fa-check"></i> Terkirim!';
                                submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';

                                setTimeout(() => {
                                    submitBtn.innerHTML = originalHTML;
                                    submitBtn.disabled = false;
                                    submitBtn.style.background = '';
                                }, 3000);

                                alert('Pesan Anda telah terkirim! Kami akan segera menghubungi Anda.');
                            }, 2000);
                        });
                    }

                    // Smooth scrolling for anchor links
                    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                        anchor.addEventListener('click', function(e) {
                            e.preventDefault();
                            const target = document.querySelector(this.getAttribute('href'));
                            if (target) {
                                target.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }
                        });
                    });
                });
            </script>
        @endsection
