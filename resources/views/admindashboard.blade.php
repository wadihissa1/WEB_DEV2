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
 
        /* Navbar styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 200px;
            height: 100%;
            background-color: #333;
            padding: 20px;
            color: #fff;
        }
 
        .navbar a {
            display: block;
            margin-bottom: 10px;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            cursor: pointer;
        }
 
        /* Content styles */
        .content {
            margin-left: 220px; /* Adjust margin to account for navbar width */
            padding: 20px;
        }
 
        /* Hide by default */
        .hidden {
            display: none;
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
 
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="#" onclick="showPendingRequests()">Pending Requests</a>
        <a href="#" onclick="showCreateCategories()">Create Categories</a>
        <a href="#" onclick="showViewCategories()">View Categories</a>
    </div>
 
    <!-- Content -->
    <div class="content" id="pendingRequests">
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
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->description }}</td>
                            <td>{{ $request->status }}</td>
                            <td>
                                <form action="{{ route('admin.approveRequest', $request->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Approve</button>
                                </form>
                                <form action="{{ route('admin.rejectRequest', $request->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No pending store requests.</p>
        @endif
    </div>
 
    <div class="content hidden" id="createCategories">
        <h1>Create categories</h1>
    <a href="{{ route('createcategory') }}" class="btn">Create CAtegorie</a>        <!-- Your create categories HTML content goes here -->
    </div>
    <div class="content hidden" id="viewCategories">
    <h1>View Categories</h1>
    @if($categories->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <!-- Add other table headers if needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <!-- Add other table cells if needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No categories found.</p>
@endif
 
</div>
 
<script>
    // Function to show pending requests
    function showPendingRequests() {
        document.getElementById('pendingRequests').classList.remove('hidden');
        document.getElementById('createCategories').classList.add('hidden');
        document.getElementById('viewCategories').classList.add('hidden');
    }
 
    // Function to show create categories
    function showCreateCategories() {
        document.getElementById('createCategories').classList.remove('hidden');
        document.getElementById('pendingRequests').classList.add('hidden');
        document.getElementById('viewCategories').classList.add('hidden');
    }
 
    // Function to show view categories
    function showViewCategories() {
        document.getElementById('viewCategories').classList.remove('hidden');
        document.getElementById('createCategories').classList.add('hidden');
        document.getElementById('pendingRequests').classList.add('hidden');
    }
</script>
 
</body>
</html>
 