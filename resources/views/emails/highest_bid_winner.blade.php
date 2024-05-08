    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Congratulations!</title>
    </head>
    <body>
    <h2>You won</h2>

    <p>Dear {{ $user->name }},</p>
    <p>You have won the bid for the product "{{ $product->name }}" in the event.</p>
    <p>Here are the details:</p>
    <p>- Product Name: {{ $product->name }}</p>
    <p> - Bid Amount: ${{ $bidAmount }}</p>

    <p>Thank you for participating!</p>
    </body>
    </html>
