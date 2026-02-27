<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reminder</title>
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
            padding: 20px 0;
            border-bottom: 3px solid #1e40af;
        }
        .header h1 {
            color: #1e40af;
            margin: 0;
        }
        .content {
            padding: 30px 0;
        }
        .event-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #1e40af;
        }
        .event-details h2 {
            margin-top: 0;
            color: #1e40af;
        }
        .detail-row {
            margin: 10px 0;
        }
        .detail-label {
            font-weight: 600;
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
        .footer {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #e5e7eb;
            margin-top: 30px;
            font-size: 0.875rem;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>House of Hope Church Leeds</h1>
        <p>Event Reminder</p>
    </div>

    <div class="content">
        <p>Dear {{ $rsvp->name }},</p>

        <p>This is a friendly reminder about your upcoming event at House of Hope Church Leeds.</p>

        <div class="event-details">
            <h2>{{ $event->title }}</h2>
            
            <div class="detail-row">
                <span class="detail-label">Date:</span>
                {{ $event->date->format('l, F j, Y') }}
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Time:</span>
                {{ $event->time }}
            </div>
            
            @if($event->location)
            <div class="detail-row">
                <span class="detail-label">Location:</span>
                {{ $event->location }}
            </div>
            @endif
            
            @if($event->description)
            <div class="detail-row">
                <p>{{ $event->description }}</p>
            </div>
            @endif
        </div>

        <p style="text-align: center;">
            <a href="{{ route('events.show', $event->id) }}" class="button">View Event Details</a>
        </p>

        <p>We look forward to seeing you there!</p>

        <p>If you can no longer attend, please let us know by replying to this email.</p>
    </div>

    <div class="footer">
        <p>
            House of Hope Church Leeds<br>
            Swarcliffe Community Centre, 65 Stanks Gardens, Leeds LS14 5LS<br>
            <a href="tel:+447359459090">+447359459090</a>
        </p>
        
        <p>
            You're receiving this email because you RSVP'd to this event.<br>
            <a href="{{ route('events.show', $event->id) }}">Manage your RSVP</a>
        </p>
    </div>
</body>
</html>
