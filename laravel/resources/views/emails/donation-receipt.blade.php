@component('mail::message')
# Donation Receipt

Thank you for your generous donation to House of Hope Leeds!

**Donation Details**

- **Amount:** ${{ $amount }} USD
- **Type:** {{ $frequency }}
- **Payment Method:** {{ $provider }}
- **Date:** {{ $donation->created_at->format('M d, Y') }}

Your donation helps us fulfill our mission to love God, love people, and make disciples.

@if($donation->frequency === 'recurring')
Your monthly donation will be charged on the same date each month unless you modify or cancel your subscription.
@endif

If you have any questions, please contact us at info@houseofhopeleeds.org.

@component('mail::button', ['url' => config('app.url')])
Visit Our Website
@endcomponent

In His service,
House of Hope Leeds
@endcomponent
