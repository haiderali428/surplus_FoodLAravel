<footer class="pt-4 pb-2 mt-5 border-top" style="background: linear-gradient(90deg, var(--color-primary, #0C8C85) 0%, var(--color-secondary, #ff9900) 100%); color: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 mb-3 mb-md-0 text-center text-md-start">
                <span class="fw-bold" style="font-size: 1.1rem;">&copy; {{ date('Y') }} Surplus Food. All rights reserved.</span>
                <br>
                <small class="text-light">Empowering communities, reducing food waste.</small>
            </div>
            <div class="col-md-4 mb-3 mb-md-0 text-center">
                <a href="{{ route('home') }}" class="text-white mx-2 text-decoration-none fw-semibold">Home</a>
                <a href="{{ route('about_us') }}" class="text-white mx-2 text-decoration-none fw-semibold">About Us</a>
                <a href="{{ route('contact_us') }}" class="text-white mx-2 text-decoration-none fw-semibold">Contact us</a>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <span class="me-2">Follow us:</span>
                <a href="https://facebook.com/yourpage" class="text-white mx-1" style="font-size: 1.3rem;" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://tiktok.com/@yourpage" class="text-white mx-1" style="font-size: 1.3rem;" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="https://instagram.com/yourpage" class="text-white mx-1" style="font-size: 1.3rem;" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer> 