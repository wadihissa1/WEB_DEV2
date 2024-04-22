<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f8f9fa;
}

/* Heading styles */
h1 {
    color: #333;
    margin-bottom: 20px;
}

/* Button styles */
.btn {
    display: inline-block;
    padding: 8px 12px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    margin-right: 10px;
}

.btn-danger {
    background-color: #dc3545;
}

.btn-success {
    background-color: #28a745;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}
#rejectbutton{
    color:white;
    background:red;
    border-color:red;
    padding:10px;
    margin:5px;
    border-radius:10px;
    cursor:pointer;
}
#approvebutton{
    color:white;
    background:green;
    border-color:green;
    padding:10px;
    margin:5px;
    border-radius:10px;
    cursor:pointer;
}
th {
    background-color: #f2f2f2;
}

/* Form styles */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input[type="text"],
.form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Alert styles */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
        </style>
</head>
<body>
    <h1>Pending Store Requests</h1>

    @if($pendingRequests->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pendingRequests as $request)
    <tr>
        <td>{{ $request->name }} </td><td>{{ $request->description }}</td>
       <td> {{ $request->status }}</td>
    
    <form action="{{ route('admin.approveRequest', $request->id) }}" method="POST">
        @csrf
      <td>  <button id="approvebutton" type="submit">Approve</button>
    </form>
    
    <form action="{{ route('admin.rejectRequest', $request->id) }}" method="POST">
        @csrf
        <button id="rejectbutton" type="submit">Reject</button></td></tr>
    </form>
@endforeach
            </tbody>
        </table>
    @else
        <p>No pending store requests.</p>
    @endif
</body>
</html>
