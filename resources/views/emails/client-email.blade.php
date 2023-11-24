<!DOCTYPE html>
<html>
<head>
    <title>Your Email Title</title>
</head>
<body>
    <h1>Hello, {{ $data['name'] }}</h1>
    <p>Congratulation {{ $data['name'] }}, Please find your login detail for panel </p>
    <p>Username :- {{ $data['email'] }}</p>
    <p>password :- {{ $data['password'] }}</p>
</body>
</html>
