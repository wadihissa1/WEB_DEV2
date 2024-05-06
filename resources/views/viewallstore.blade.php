@extends('layout')
@section('content')
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Stores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            background-image: url("/images/createstore-background.webp");
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px);
        }
         
        h1{
            color: #ff523b;
            font-size: 55px;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid  #ff523b;
            padding: 8px;
            text-align: left;
        }

        td{
            font-weight: 900;
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
            width: max-content;
            border-radius: 4px;
            border-color:  #ff523b;
        }
        .btn1 {
            padding: 8px 12px;
        background-color: #ff523b;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        transition: .2s;
        margin-top: 40px;
        }
        .btn1:hover{
            background-color: #fff;
        color: #ff523b;
        border: 4px solid #ff523b;
        }

        

        .no-stores {
            text-align: center;
            color: #ff523b ;
        }

        .content{
            margin: 150px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

    </style>
</head>
<body>
<div class="content">
<h1>{{auth()->user()->name}} Stores:</h1>

    <!-- Your Stores Section -->
    <h2>Your Stores:</h2>
   <a class="btn" href="{{ route('viewpendingrequests') }}">View Pending Requests</a>

    @if($userStores && $userStores->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Store ID</th>
                    <th>Store Name</th>
                    <th>Description</th>
                    <th>View Store Details</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userStores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->description }}</td>
                        <td><!--<a class="btn" href="{{ route('viewstore', ['store' => $store->id]) }}">View</a> -->
                        <a class="btn" href="{{ route('createproduct', ['storeId' => $store->id]) }}">Create Products</a>
                        <a class="btn" href="{{ route('viewproducts', ['storeId' => $store->id]) }}">View Products</a>
                    </td> 
                    <td>
    <a class="btn" href="{{ route('editstore', ['storeId' => $store->id]) }}">Edit</a>
</td>
<td>
    <form action="{{ route('deletestore', ['storeId' => $store->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this store?')">Delete</button>
    </form>
</td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-stores">You have no stores yet. Create your first store!</p>
        <a class="btn1" href="{{ route('createstore', ['id' => auth()->id()]) }}">Create Your first Store</a>
    @endif
  </div>
</body>
</html>
@endsection