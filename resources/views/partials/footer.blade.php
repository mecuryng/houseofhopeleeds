<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="d-flex align-items-center mb-3">
                    <img src="/logo.png " alt="House of Hope" class="me-2" style="height:40px; width:auto;">
                    <h4 class="h5 mb-0">House of Hope Church Leeds</h4>
                </div>
                <p class="">
                    A place where you can belong, believe, and become all that God created you to be.
                </p>
                <p> </p>
                </br>
                </br>
                
            </div>

            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5 class="mb-3">Quick Links</h5>
                <div class="footer-links">
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}">Home</a></li>
                        <li class="mb-2"><a href="{{ url('/about') }}">About Us</a></li>
                        <li class="mb-2"><a href="{{ url('/sermons') }}">Sermons</a></li>
                        <li class="mb-2"><a href="{{ url('/ministries') }}">Ministries</a></li>
                        <li class="mb-2"><a href="{{ url('/events') }}">Events</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5 class="mb-3">Connect</h5>
                <div class="footer-links">
                    <ul class="list-unstyled">
                        <li class="text-muted mb-2"><a href="{{ url('/visit') }}">Plan a Visit</a></li>
                        <li class="mb-2"><a href="{{ url('/new') }}">New Here?</a></li>
                        <li class="mb-2"><a href="{{ url('/prayer') }}">Prayer Requests</a></li>
                        <li class="mb-2"><a href="{{ url('/donate') }}">Giving</a></li>
                        <li class="mb-2"><a href="{{ url('/staff') }}">Staff Directory</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <h5 class="mb-3">Newsletter</h5>
                <p class="text-white small mb-3">Stay updated with our latest news and events.</p>
                <form class="d-flex">
                    <input type="email" class="form-control me-2" placeholder="Your email">
                    <button type="submit" class="btn btn-primary">Join</button>
                </form>
                <div class="mt-3">
                    <a href="#" class=" me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        <hr class="my-4 border-secondary ">
        <div class="text-center  small opacity-25">
            <p class=" small">
                    &copy;  {{ date('Y') }} House of Hope Church Leeds. All rights reserved.
                </p>
            House of Hope Church Leeds is a registered 501(c)(3) non-profit organization.
        </div>
    </div>
</footer>
