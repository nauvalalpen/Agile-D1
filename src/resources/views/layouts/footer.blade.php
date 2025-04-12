{{-- resources/views/layouts/footer.blade.php --}}
<footer class="bg-black text-white pt-5 pb-4">
    <div class="container">
        <div class="row gy-4"> {{-- gy-4 untuk vertical gap pada layar kecil --}}
            {{-- Kolom Support --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3 small text-uppercase" style="color: #ffffff;">Support</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">Help Center</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">Safety information</a>
                    </li>
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">Cancellation
                            options</a></li>
                </ul>
            </div>

            {{-- Kolom Company --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3 small text-uppercase" style="color: #ffffff;">Company</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">About us</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">Privacy policy</a>
                    </li>
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">Community Blog</a>
                    </li>
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">Terms of service</a>
                    </li>
                </ul>
            </div>

            {{-- Kolom Contact --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3 small text-uppercase" style="color: #ffffff;">Contact</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">FAQ</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">Get in touch</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link">Partnerships</a></li>
                </ul>
            </div>

            {{-- Kolom Social --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3 small text-uppercase" style="color: #ffffff;">Social</h5>
                <div class="d-flex">
                    {{-- Ganti '#' dengan link sosial media yang benar --}}
                    <a href="#" class="footer-link me-3 fs-5"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="footer-link me-3 fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="footer-link me-3 fs-5"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="footer-link me-3 fs-5"><i class="fab fa-youtube"></i></a>
                    {{-- Tambah ikon lain jika perlu --}}
                </div>
            </div>
        </div>

        {{-- Separator --}}
        <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.15);">

        {{-- Bottom Bar --}}
        <div class="row align-items-center">
            {{-- Copyright --}}
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="small mb-0" style="color: #a0aec0;">© Copyright oneVision 2025</p> {{-- Warna abu-abu --}}
            </div>
            {{-- Payment Icons --}}
            <div class="col-md-6 text-center text-md-end">
                <i class="fab fa-cc-visa fs-4 me-2" style="color: #a0aec0;"></i>
                <i class="fab fa-cc-mastercard fs-4 me-2" style="color: #a0aec0;"></i>
                <i class="fab fa-cc-discover fs-4 me-2" style="color: #a0aec0;"></i>
                {{-- Ganti dengan ikon Discover jika ada, atau ikon lain --}}
                <i class="fab fa-cc-paypal fs-4 me-2" style="color: #a0aec0;"></i>
                <i class="fab fa-cc-amex fs-4 me-2" style="color: #a0aec0;"></i> {{-- Contoh ikon Amex --}}
            </div>
        </div>
    </div>
</footer>

{{-- Tambahkan CSS ini di bagian <style> atau file CSS terpisah --}}
<style>
    .footer-link {
        color: #a0aec0;
        /* Warna link default (abu-abu) */
        transition: color 0.2s ease-in-out;
    }

    .footer-link:hover {
        color: #ffffff !important;
        /* Warna link saat hover (putih) */
    }
</style>
