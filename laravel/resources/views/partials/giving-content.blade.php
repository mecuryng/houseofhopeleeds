<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Biblical Foundation</h2>
            <p class="text-muted">What scripture teaches about giving</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="give-icon bg-primary text-white">
                        <i class="fas fa-bible"></i>
                    </div>
                    <h4 class="h5">Tithes & Offerings</h4>
                    <p class="text-muted">
                        "Bring the whole tithe into the storehouse... Test me in this," says the Lord Almighty.
                    </p>
                    <cite class="text-primary fw-bold">Malachi 3:10</cite>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="give-icon bg-success text-white">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4 class="h5">Cheerful Giving</h4>
                    <p class="text-muted">
                        "Each of you should give what you have decided in your heart to give, not reluctantly or under compulsion, for God loves a cheerful giver."
                    </p>
                    <cite class="text-primary fw-bold">2 Corinthians 9:7</cite>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="give-icon bg-info text-white">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h4 class="h5">Serving Others</h4>
                    <p class="text-muted">
                        "Each of you should use whatever gift you have received to serve others, as faithful stewards of God's grace."
                    </p>
                    <cite class="text-primary fw-bold">1 Peter 4:10</cite>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" id="give-form">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Ways to Give</h2>
            <p class="text-muted">Choose the method that works best for you</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card give-card text-center">
                    <div class="card-body p-4">
                        <div class="give-icon bg-primary text-white">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="h5">Online Giving</h4>
                        <p class="text-muted mb-3">Give securely online using credit/debit card or bank transfer</p>
                        <a href="#online-giving" class="btn btn-primary">Give Online <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card give-card text-center">
                    <div class="card-body p-4">
                        <div class="give-icon bg-success text-white">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h4 class="h5">Mail a Check</h4>
                        <p class="text-muted mb-3">Send your gift to our church office</p>
                        <div class="small text-muted">
                            Grace Community Church<br>
                            123 Faith Street<br>
                            Hope City, HC 12345
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card give-card text-center">
                    <div class="card-body p-4">
                        <div class="give-icon bg-info text-white">
                            <i class="fas fa-church"></i>
                        </div>
                        <h4 class="h5">In Person</h4>
                        <p class="text-muted mb-3">Give during any of our worship services</p>
                        <div class="small text-muted">
                            Sunday: 9:00 AM & 11:00 AM<br>
                            Wednesday: 6:30 PM
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Online Giving Form -->
        <div class="card shadow-lg" id="online-giving">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"><i class="fas fa-hand-holding-heart me-2"></i> Online Giving</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Column - Amount Selection -->
                    <div class="col-lg-6">
                        <h4 class="mb-4">Choose Amount</h4>

                        <div class="mb-4">
                            <div class="btn-group d-flex flex-wrap gap-2" role="group">
                                <button type="button" class="btn btn-outline-primary amount-btn">$25</button>
                                <button type="button" class="btn btn-outline-primary amount-btn">$50</button>
                                <button type="button" class="btn btn-outline-primary amount-btn">$100</button>
                                <button type="button" class="btn btn-outline-primary amount-btn">$250</button>
                                <button type="button" class="btn btn-outline-primary amount-btn">$500</button>
                                <button type="button" class="btn btn-outline-primary amount-btn">Other</button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="customAmount" class="form-label">Custom Amount ($)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="customAmount" placeholder="Enter amount" min="1" step="0.01">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Frequency</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="frequency" id="oneTime" value="one-time" checked>
                                <label class="form-check-label" for="oneTime">One-Time</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="frequency" id="weekly" value="weekly">
                                <label class="form-check-label" for="weekly">Weekly</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="frequency" id="monthly" value="monthly">
                                <label class="form-check-label" for="monthly">Monthly</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Designation (Optional)</label>
                            <select class="form-select">
                                <option value="">General Fund</option>
                                <option value="missions">Missions</option>
                                <option value="building">Building Fund</option>
                                <option value="youth">Youth Ministry</option>
                                <option value="children">Children's Ministry</option>
                                <option value="outreach">Community Outreach</option>
                            </select>
                        </div>
                    </div>

                    <!-- Right Column - Payment Info -->
                    <div class="col-lg-6">
                        <h4 class="mb-4">Payment Information</h4>

                        <div class="mb-4">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="John Smith">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="john@example.com">
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Payment Method</label>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="payment-method active">
                                        <div class="d-flex align-items-center">
                                            <div class="payment-icon bg-primary text-white">
                                                <i class="fab fa-cc-visa"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">Credit/Debit Card</div>
                                                <div class="small text-muted">Visa, Mastercard, Amex</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="payment-method">
                                        <div class="d-flex align-items-center">
                                            <div class="payment-icon bg-success text-white">
                                                <i class="fas fa-university"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">Bank Transfer</div>
                                                <div class="small text-muted">ACH Direct Debit</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="cardNumber" class="form-label">Card Number</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fab fa-cc-visa text-primary"></i>
                                </span>
                                <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="expiry" class="form-label">Expiry Date</label>
                                <input type="text" class="form-control" id="expiry" placeholder="MM/YY">
                            </div>
                            <div class="col-md-6">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" placeholder="123">
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="savePayment" value="save">
                            <label class="form-check-label" for="savePayment">Save payment method for future giving</label>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg give-submit-btn">
                                <i class="fas fa-lock me-2"></i> Securely Give Now - $100.00
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="impact">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Your Impact</h2>
            <p class="text-muted">See how your generosity makes a difference</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="give-icon bg-primary text-white">
                                <i class="fas fa-users"></i>
                            </div>
                            <h4 class="h5">Community Outreach</h4>
                        </div>
                        <div class="impact-item">
                            <div class="impact-icon bg-primary text-white">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">$50</h6>
                                <p class="mb-0 text-muted small">Feeds a family for a week through our food pantry</p>
                            </div>
                        </div>
                        <div class="impact-item">
                            <div class="impact-icon bg-primary text-white">
                                <i class="fas fa-book"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">$25</h6>
                                <p class="mb-0 text-muted small">Provides Bibles for new believers</p>
                            </div>
                        </div>
                        <div class="impact-item">
                            <div class="impact-icon bg-primary text-white">
                                <i class="fas fa-home"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">$100</h6>
                                <p class="mb-0 text-muted small">Supports housing assistance for families in need</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="give-icon bg-success text-white">
                                <i class="fas fa-child"></i>
                            </div>
                            <h4 class="h5">Children & Youth</h4>
                        </div>
                        <div class="impact-item">
                            <div class="impact-icon bg-success text-white">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">$75</h6>
                                <p class="mb-0 text-muted small">Supplies technology for youth ministry programs</p>
                            </div>
                        </div>
                        <div class="impact-item">
                            <div class="impact-icon bg-success text-white">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">$30</h6>
                                <p class="mb-0 text-muted small">Provides curriculum for children's Sunday school</p>
                            </div>
                        </div>
                        <div class="impact-item">
                            <div class="impact-icon bg-success text-white">
                                <i class="fas fa-campground"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">$200</h6>
                                <p class="mb-0 text-muted small">Sends a child to summer camp</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="give-icon bg-info text-white">
                                <i class="fas fa-globe-americas"></i>
                            </div>
                            <h4 class="h5">Global Missions</h4>
                        </div>
                        <div class="impact-item">
                            <div class="impact-icon bg-info text-white">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">$150</h6>
                                <p class="mb-0 text-muted small">Supports a missionary family for one month</p>
                            </div>
                        </div>
                        <div class="impact-item">
                            <div class="impact-icon bg-info text-white">
                                <i class="fas fa-church"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">$500</h6>
                                <p class="mb-0 text-muted small">Helps build churches in unreached areas</p>
                            </div>
                        </div>
                        <div class="impact-item">
                            <div class="impact-icon bg-info text-white">
                                <i class="fas fa-water"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">$250</h6>
                                <p class="mb-0 text-muted small">Provides clean water for a village</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Giving Steps -->
        <div class="text-center mb-5">
            <h2 class="section-title">How to Give</h2>
            <p class="text-muted">Simple steps to make your gift</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="step-number">1</div>
                    <div>
                        <h5 class="mb-2">Choose Your Amount</h5>
                        <p class="text-muted">Select a suggested amount or enter your own custom gift</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="step-number">2</div>
                    <div>
                        <h5 class="mb-2">Select Payment Method</h5>
                        <p class="text-muted">Use credit/debit card or bank transfer - both are secure</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="step-number">3</div>
                    <div>
                        <h5 class="mb-2">Complete Your Gift</h5>
                        <p class="text-muted">Receive instant confirmation and tax receipt</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">2025 Impact Report</h2>
            <p class="text-muted">Your generosity in action</p>
        </div>

        <div class="row text-center g-4 mb-5">
            <div class="col-md-3">
                <div class="display-4 fw-bold text-primary">$1.2M</div>
                <p class="text-muted">Total Given</p>
            </div>
            <div class="col-md-3">
                <div class="display-4 fw-bold text-success">8,542</div>
                <p class="text-muted">Meals Served</p>
            </div>
            <div class="col-md-3">
                <div class="display-4 fw-bold text-info">347</div>
                <p class="text-muted">Baptisms</p>
            </div>
            <div class="col-md-3">
                <div class="display-4 fw-bold text-warning">18</div>
                <p class="text-muted">Mission Trips</p>
            </div>
        </div>

        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <h4 class="mb-3"><i class="fas fa-chart-pie me-2 text-primary"></i> Fund Allocation</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="progress mb-3" style="height: 25px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
                                <span class="fw-bold">45% Ministry Programs</span>
                            </div>
                        </div>
                        <div class="progress mb-3" style="height: 25px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                <span class="fw-bold">25% Missions & Outreach</span>
                            </div>
                        </div>
                        <div class="progress mb-3" style="height: 25px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="fw-bold">20% Facility & Operations</span>
                            </div>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                <span class="fw-bold">10% Debt Reduction</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="bg-light p-3 rounded">
                            <h5 class="mb-3">Stewardship Commitment</h5>
                            <p class="small">
                                We are committed to using every dollar wisely and transparently. 
                                Annual financial reports are available to all church members.
                            </p>
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-file-pdf me-1"></i> Download Full Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Frequently Asked Questions</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Is my online giving secure?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! We use industry-standard 256-bit SSL encryption to protect your personal and financial information. Our payment processor is PCI Level 1 compliant, the highest level of security certification available.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Will I receive a tax receipt?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, you'll receive an immediate email confirmation of your gift. At the end of each year, we provide an annual giving statement for tax purposes to all donors who gave $250 or more during the year.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Can I set up recurring giving?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Absolutely! When giving online, you can choose to give weekly, monthly, or on a custom schedule. You can manage, modify, or cancel your recurring gifts at any time through your giving profile.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                How are giving decisions made?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Our church budget is prayerfully prepared by church leadership and approved annually by our congregation. We follow biblical principles of wise stewardship and transparent financial management.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <h2 class="mb-4">Questions About Giving?</h2>
                <p class="lead mb-4">Our finance team is here to help with any questions about your giving or church finances.</p>

                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-user-tie fs-4 me-3 mt-1"></i>
                    <div>
                        <h5 class="h6">Finance Director</h5>
                        <p class="mb-0">Sarah Johnson</p>
                        <p class="mb-0">(555) 123-4567 ext. 102</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-envelope fs-4 me-3 mt-1"></i>
                    <div>
                        <h5 class="h6">Email</h5>
                        <p class="mb-0">finance@gracecommunity.org</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-4">
                    <i class="fas fa-clock fs-4 me-3 mt-1"></i>
                    <div>
                        <h5 class="h6">Office Hours</h5>
                        <p class="mb-0">Monday-Friday: 9am-4pm</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="bg-white bg-opacity-10 p-4 rounded">
                    <h3 class="mb-4">Contact Form</h3>
                    <form>
                        <div class="mb-3">
                            <label for="contactName" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="contactName" placeholder="John Smith">
                        </div>
                        <div class="mb-3">
                            <label for="contactEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="contactEmail" placeholder="john@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="contactMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="contactMessage" rows="3" placeholder="How can we help you?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-light w-100">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
