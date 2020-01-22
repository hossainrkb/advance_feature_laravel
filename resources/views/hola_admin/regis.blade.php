<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="POST" action="{{ route('admin.regis.submit') }}">
    @csrf
<b>Name</b>
<b><input type="text" name="name" placeholder="Enter your name" required="" autocomplete="off"  /></b>
<b>Email</b>
<b><input type="email" name="email" placeholder="Enter your email" required="" autocomplete="off"  /></b>
<b><input type="submit" value="registration" /></b>
</form>
</body>
</html>
