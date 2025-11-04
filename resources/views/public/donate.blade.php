@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-4xl font-bold mb-6">Support House of Hope Leeds</h1>
        <p class="text-lg mb-6">Thank you for considering a donation. Your support helps us run services, community outreach, and ministry programs.</p>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4">Donate Online</h2>
            <p class="mb-4">We accept one-time and recurring donations via our secure payment partner.</p>
            <a href="#" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">Donate Now</a>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4">Other Ways to Give</h2>
            <ul class="text-left list-disc list-inside text-gray-700">
                <li>Bank transfer (details below)</li>
                <li>In-person during our Sunday service</li>
                <li>By cheque payable to House of Hope Leeds</li>
            </ul>

            <div class="mt-4 text-sm text-gray-600">
                <p>Bank: Example Bank</p>
                <p>Account: 12345678</p>
                <p>Sort code: 12-34-56</p>
            </div>
        </div>

        <p class="mt-8 text-sm text-gray-600">If you have questions about donating, please <a href="mailto:info@houseofhopeleeds.org" class="text-blue-600">contact us</a>.</p>
    </div>
</div>
@endsection
