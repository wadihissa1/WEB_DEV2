<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Stores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
       
        }
         
        h1, h2 {
            color: #ff523b;
            text-align: center;
        }
 
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
 
        th, td {
            border: 1px solid  #ff523b;
            padding: 8px;
            text-align: left;
        }
 
        th {
            background-color:  #ff523b;
            color: white;
        }
 
        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            background-color:  #ff523b;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn1 {
            display: center;
            padding: 8px 12px;
            margin: 5px;
            background-color:  #ff523b;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            text-align:center;
            margin-left:560px;
            margin-top:40px;
 
        }
 
       
 
        .no-stores {
            text-align: center;
            color: #ff523b ;
        }
    </style>
</head>
<body>
    <h1>All Stores</h1>
 
    <!-- Your Stores Section -->
    <h2>Your Stores:</h2>
 
    @if($userStores && $userStores->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Store ID</th>
                    <th>Store Name</th>
                    <th>Description</th>
                    <th>View Store Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userStores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->description }}</td>
                        <td><a class="btn" href="{{ route('viewstore', ['store' => $store->id]) }}">View</a> </td>
                        <td><a class="btn" href="{{ route('createproduct', ['storeId' => $store->id]) }}">Create Products</a>
                    </td>
 
 
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-stores">You have no stores yet. Create your first store!</p>
        <a class="btn1" href="{{ route('createstore', ['id' => auth()->id()]) }}">Create Your first Store</a>
    @endif
 
</body>
</html>
 