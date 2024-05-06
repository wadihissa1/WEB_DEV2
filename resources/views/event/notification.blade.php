<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Event Created</title>
</head>
<body>
<h2>New Event Created</h2>

<p>A new event has been created by:</p>
<p><strong>Store Name:</strong> {{ $event->store->name }}</p>
<p><strong>Name:</strong> {{ $event->name }}</p>
<p><strong>Description:</strong> {{ $event->description }}</p>
<p><strong>Date/Time:</strong> {{ $event->date_time }}</p>

<p>Thank you for using our platform!</p>
</body>
</html>
