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
            background-image: url('/images/patern.png');
            backdrop-filter: blur(10px);
            background-size: cover;
            background-position: center;
        }

        button {
            padding: 10px 20px;
            background-color: #3333339a;
            color: #fff;
            border: 0;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: .3s;
            cursor: pointer;
        }

        button:hover {
            background-color: #c0b8b8;
            color: #3333339a;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        input {
            width: 400px;
            height: 40px;
            margin: 20px;
            border: none;
            outline: none;
            caret-color: rgb(255, 81, 0);
            border-radius: 30px;
            padding-left: 15px;
            letter-spacing: 0.8px;
            color: rgb(19, 19, 19);
            font-size: 13.4px;
        }

        h1 {
            font-size: 40px;
            text-align: center;
            opacity: 40%;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: fit-content;
            height: 100%;
            background-color: #3333339a;
            color: #fff;
        }

        .navbar a {
            display: block;
            width: 162px;
            height: 80px;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            align-content: center;
            text-align: center;
            background-color: transparent;
            font-weight: 900;
            cursor: pointer;
            transition: .3s;
        }

        .navbar a:hover {
            background-color: #fff;
            width: 250px;
            font-size: 18px;
            color: #333;
            background-image: url('/images/patern.png');
            background-size: cover;
            background-position: center;
        }

        .dlt_btn:hover{
            background-color: #a13529cd;
            color: #fff;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
            height: 50pc;
        }

        .hidden {
            display: none;
        }

        img {
            opacity: 20%;
            margin-top: 100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-left: 40px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;

        }

        td {
            max-width: 300px;
            overflow: hidden;
        }


        th {
            background-color: #f2f2f2;
        }

        .empty_img {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="#" onclick="showPendingRequests()">Pending Requests</a>
        <a href="#" onclick="showCreateCategories()">Create Categories</a>
        <a href="#" onclick="showViewCategories()">View Categories</a>
        <a href="#" onclick="showApprovedStores()">Approved Stores</a>
    </div>

    <!-- Content -->
    <div class="content" id="pendingRequests">
        <h1>View Pending Requests</h1>
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
                    <td style="word-wrap: break-word;">{{ $request->description }}</td>
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
        <div class="empty_img">
            <img src="{{ asset('images/ohno.jpg') }}" alt="">
            <h1>No pending store requests.</h1>
        </div>

        @endif
    </div>

    <div class="content hidden" id="createCategories">
        <h1>Create Category</h1>

        @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('storecategory') }}" method="POST">
            @csrf
            <div>
                <input type="text" id="name" name="name" required>
            </div>
            <button type="submit">Create</button>
        </form>
    </div>
    <div class="content hidden" id="viewCategories">
        <h1>View Categories</h1>
        @if($categories->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td style="width: 20%;" ><button type="submit" class="dlt_btn">Delete</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty_img">
        <img src="{{ asset('images/ohno.jpg') }}" alt="">
        <h1>No categories found.</h1>
        </div>
        @endif
    </div>
        <div class="content hidden" id="approvedStores">
    <h1>Approved Stores</h1>
    @if($approvedStores->count() > 0)
    <table>
        <thead>
            <tr>
            <th>User ID</th>
                <th>User Name</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($approvedStores as $store)
            <tr>
            <td>{{ $store->user->id }}</td>
             <td>{{ $store->user->name }}</td>
                <td>{{ $store->name }}</td>
                <td>{{ $store->description }}</td>
                <td>{{ $store->status }}</td>
                <td>
                <form action="{{ route('admin.activateStore', $store->id) }}" method="POST">
    @csrf
    <button type="submit">Activate</button>
</form>
<form action="{{ route('admin.deactivateStore', $store->id) }}" method="POST">
    @csrf
    <button type="submit">Deactivate</button>
</form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty_img">
        <img src="{{ asset('images/ohno.jpg') }}" alt="">
        <h1>No approved stores found.</h1>
    </div>
    @endif
</div>
    

    <script>
        // Function to show pending requests
    function showPendingRequests() {
        document.getElementById('pendingRequests').classList.remove('hidden');
        document.getElementById('createCategories').classList.add('hidden');
        document.getElementById('viewCategories').classList.add('hidden');
        document.getElementById('approvedStores').classList.add('hidden');
    }

    // Function to show create categories
    function showCreateCategories() {
        document.getElementById('createCategories').classList.remove('hidden');
        document.getElementById('pendingRequests').classList.add('hidden');
        document.getElementById('viewCategories').classList.add('hidden');
        document.getElementById('approvedStores').classList.add('hidden');
    }

    // Function to show view categories
    function showViewCategories() {
        document.getElementById('viewCategories').classList.remove('hidden');
        document.getElementById('createCategories').classList.add('hidden');
        document.getElementById('pendingRequests').classList.add('hidden');
        document.getElementById('approvedStores').classList.add('hidden');
    }
    function showApprovedStores() {
        document.getElementById('approvedStores').classList.remove('hidden');
        document.getElementById('createCategories').classList.add('hidden');
        document.getElementById('pendingRequests').classList.add('hidden');
        document.getElementById('viewCategories').classList.add('hidden'); // Hide view categories
    }
    </script>

</body>

</html>