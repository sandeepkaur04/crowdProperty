<!DOCTYPE html>
<html lang="en">
<head>
  <title>Crowd Property</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    @if(Auth::check())
    <span class="pull-right">
      <a href="{{ url('/batches') }}"> Batches</a> | 
      <a href="{{ url('/logout') }}"> Logout</a>
    </span>
    @endif
    @yield('content')
</div>

</body>
</html>
