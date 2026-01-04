document.addEventListener('DOMContentLoaded', function() {
    // Intersection observer for service/event cards
    const serviceCards = document.querySelectorAll('.service-card, .event-card');
    if (serviceCards.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        serviceCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    }

    // Giving page interactions
    const amountButtons = document.querySelectorAll('.amount-btn');
    const customAmountInput = document.getElementById('customAmount');

    if (amountButtons.length) {
        amountButtons.forEach(button => {
            button.addEventListener('click', function() {
                amountButtons.forEach(btn => btn.classList.remove('btn-primary'));
                amountButtons.forEach(btn => btn.classList.add('btn-outline-primary'));
                this.classList.add('btn-primary');
                this.classList.remove('btn-outline-primary');

                const amount = this.textContent.trim();
                const giveButton = document.querySelector('.give-submit-btn');
                if (giveButton) {
                    giveButton.innerHTML = `<i class="fas fa-lock me-2"></i> Securely Give Now - ${amount}`;
                }
            });
        });
    }

    if (customAmountInput) {
        customAmountInput.addEventListener('input', function() {
            if (this.value && this.value > 0) {
                const giveButton = document.querySelector('.give-submit-btn');
                if (giveButton) {
                    giveButton.innerHTML = `<i class="fas fa-lock me-2"></i> Securely Give Now - $${parseFloat(this.value).toFixed(2)}`;
                }
            }
        });
    }

    const paymentMethods = document.querySelectorAll('.payment-method');
    if (paymentMethods.length) {
        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                paymentMethods.forEach(m => m.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
});
