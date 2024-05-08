@extends('layout')
@section('content')
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Requests</title>
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
.content{
    display: flex;
    flex-direction: column;
    margin: 40px 20px 220px 20px;
    justify-content: center;
    align-items: center;
}
.description {
  overflow: hidden;
  text-overflow: ellipsis;
  max-height: 30px;
  word-wrap: break-word; 
  font-size:10px;
  cursor: default;
}
.cards {
    display: flex;
    flex-wrap: wrap;
 }
 
.card {
    width: 150px;
    height: fit-content;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    flex: 1 1 150px;
    border: 2px solid rgb(225, 225, 225);
    border-radius: 30px;
    background-color: #ffffffb0;
    color: #ff523b;
    box-sizing: border-box;
    margin: 1rem .25em;
    transition: .5s;
}

.card:hover{
    background-color: #ffffffe8;

}

.pending_header{
    font-size: 60px;
    color: #ff523b;
    text-align: center
}
.show-more {
  max-height: none;
}
.read-more-btn{
    text-decoration: none;
    border: 0;
    background-color: transparent;
    font-size: 10px;
    cursor: pointer;
}
</style>
</head>
<body>
    <div class="content">
    <h1 class="pending_header">Pending Store Requests</h1>
<br><br><br><br>
    @if($pendingRequests && $pendingRequests->count() > 0)
        <div class="cards">
                @foreach($pendingRequests as $request)
                    <div class="card">
                        <h3>{{ $request->name }}</h3>
                        <br>
                        <h2 style="font-size:12px;">Id: <span style="color: black">{{ $request->id }}</span></h2>
                        <br>
                        <h3 class="description" >Description:{{ $request->description }}</h3>
                        <button class="read-more-btn">...</button>
                        <br>
                        <h4 >Status: {{ $request->status }}</h4>
                    </div>
                @endforeach
            </div>
    @else
        <p>No pending store requests found.</p>
    @endif
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
  var descriptions = document.querySelectorAll('.description');
  var buttons = document.querySelectorAll('.read-more-btn');

  buttons.forEach(function(button, index) {
    button.addEventListener('click', function() {
      var description = descriptions[index];
      description.classList.toggle('show-more');
      if (description.classList.contains('show-more')) {
        button.innerText = 'Less';
      } else {
        button.innerText = '...';
      }
    });
  });
});
</script>
</body>
</html>
@endsection