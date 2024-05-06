<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Requests</title>
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <h1>Pending Store Requests</h1>

    @if($pendingRequests && $pendingRequests->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Store Name</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingRequests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->name }}</td>
                        <td>{{ $request->description }}</td>
                        <td>{{ $request->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No pending store requests found.</p>
    @endif

</body>
</html>
