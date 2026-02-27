<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to House of Hope Church Leeds Newsletter</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9fafb;
        }
        .header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 3px solid #1e40af;
        }
        .header h1 {
            color: #1e40af;
            margin: 0;
        }
        .content {
            padding: 30px 0;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #e5e7eb;
            margin-top: 30px;
            font-size: 0.875rem;
            color: #6b7280;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1e40af;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
        }
        .unsubscribe {
            font-size: 0.75rem;
            color: #9ca3af;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>House of Hope Church Leeds</h1>
        <p>A place to belong, grow, and shine.</p>
    </div>

    <div class="content">
        <h2>Welcome to Our Newsletter!</h2>
        
        <p>Dear {{ $subscriber->name ?? 'Friend' }},</p>
        
        <p>Thank you for subscribing to the House of Hope Church Leeds newsletter! We're excited to keep you updated with:</p>
        
        <ul>
            <li>Upcoming events and special services</li>
            <li>New sermon recordings and teachings</li>
            <li>Community news and ministry updates</li>
            <li>Opportunities to serve and connect</li>
        </ul>

        <p>We meet every Saturday at 7:45 AM at Swarcliffe Community Centre, 65 Stanks Gardens, Leeds LS14 5LS.</p>

        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ route('home') }}" class="button">Visit Our Website</a>
        </p>

        <p>If you have any questions or prayer requests, please don't hesitate to reach out to us at <a href="mailto:info@houseofhopeleeds.org">info@houseofhopeleeds.org</a>.</p>

        <p>May God bless you abundantly!</p>
        
        <p>
            <strong>The House of Hope Church Leeds Team</strong>
        </p>
    </div>

    <div class="footer">
        <p>
            House of Hope Church Leeds<br>
            Swarcliffe Community Centre, 65 Stanks Gardens, Leeds LS14 5LS<br>
            <a href="tel:+447359459090">+447359459090</a>
        </p>
        
        <p class="unsubscribe">
            You're receiving this email because you subscribed to our newsletter.<br>
            <a href="{{ $unsubscribeUrl }}">Unsubscribe</a> from our mailing list.
        </p>
    </div>
</body>
</html>
