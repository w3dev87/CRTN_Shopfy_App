<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Your Order Has Been Updated!</h1>
<p>Order Number: {{$order_number}}</p>
<p>To access your artwork, Please log in to our Customer Center</p>
<p><a href="{{route('login')}}">Login</a></p>
</body>
</html>