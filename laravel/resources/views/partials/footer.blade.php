<footer class="bg-dark text-white py-5" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="d-flex align-items-center mb-3">
                   <img src="{{ asset('Logo.png') }}" alt="" class="logo" style="height:32px; width:auto;" aria-hidden="true">
                    <span class="ms-2 h5 mb-0">House of Hope Church Leeds</span>
                </div>
                <p>A place to belong, grow, and shine.</p>
            </div>

            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h2 class="h5 mb-3">Quick Links</h2>
                <nav aria-label="Quick links">
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="{{ url('/') }}">Home</a></li>
                        <li class="mb-2"><a href="{{ url('/about') }}">About Us</a></li>
                        <li class="mb-2"><a href="{{ url('/sermons') }}">Sermons</a></li>
                        <li class="mb-2"><a href="{{ url('/ministries') }}">Ministries</a></li>
                        <li class="mb-2"><a href="{{ url('/events') }}">Events</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h2 class="h5 mb-3">Connect</h2>
                <nav aria-label="Connect links">
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="{{ url('/visit') }}">Plan a Visit</a></li>
                        <li class="mb-2"><a href="{{ url('/new') }}">New Here?</a></li>
                        <li class="mb-2"><a href="{{ url('/prayer') }}">Prayer Requests</a></li>
                        <li class="mb-2"><a href="{{ url('/donate') }}">Giving</a></li>
                        <li class="mb-2"><a href="{{ url('/staff') }}">Staff Directory</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-lg-4 col-md-4">
                <h2 class="h5 mb-3">Newsletter</h2>
                <p class="text-white small mb-3">Stay updated with our latest news and events.</p>
                <form id="newsletter-form" class="d-flex flex-column flex-sm-row gap-2" aria-label="Newsletter signup">
                    @csrf
                    <label for="newsletter-email" class="visually-hidden">Email address</label>
                    <input type="email" id="newsletter-email" name="email" class="form-control" placeholder="Your email" required aria-required="true">
                    <button type="submit" class="btn btn-primary">Join</button>
                </form>
                <div id="newsletter-message" class="mt-2 small"></div>
                <div class="mt-3 social-icons" aria-label="Social media links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>

        <hr class="my-4 border-secondary">
        <div class="text-center small opacity-75">
            <p class="mb-0">
                &copy; 2025 - {{ date('Y') }} House of Hope Church Leeds. All rights reserved.
            </p>
            <p class="mb-0 small">House of Hope Church Leeds is a registered non-profit organization.</p>
        </div>
    </div>
</footer>
