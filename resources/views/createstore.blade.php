@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Store</title>
    <!-- Include SweetAlert from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            background-color: #f5f5f5;
            background-image: url("/images/createstore-background.webp");
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px);
        }

        .form-container {
            background: radial-gradient(#fff, #ffd6d6);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            border: 2px solid #2b282825;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 90px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #ff523b;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: black;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            border-color: #ff523b;
        }

        button {
            background-color:  #ff523b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #fff;
            color: #d63a1e;
            border: 1px solid #d63a1e;
        }
    </style>
</head>
<body>
    


    <form id="createStoreForm" method="POST" action="{{ route('stores.store')}}">
        @csrf
        <h1>Create Store</h1>
        <div>
          
            <input type="text" name="name" id="name" placeholder="Store Name" value="{{ old('name') }}" required>
        </div>

        <div>
            
            <textarea name="description" placeholder="Description" id="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <button type="button" onclick="showConfirmation()">Create Store</button>
        </div>
    </form>

    <!-- Script for SweetAlert confirmation -->
    <script>
        function showConfirmation() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Your request will be submitted for admin approval.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, create it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('createStoreForm').submit();
                }
            });
        }
    </script>
</body>
</html>
@endsection