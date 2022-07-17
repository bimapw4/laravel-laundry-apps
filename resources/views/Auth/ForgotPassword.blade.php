<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Email</title>
</head>
<body>
    <h1><b>Hi, {{$data["username"]}}</b></h1>
    <p><b>Date : {{date('Y-m-d')}}</b></p>
    <p><i>Fidi Laundry </i> has received a request to reset the password for your account</p>
    <p>If you did not request to reset your password, please ignore this email.</p>
    <a href={{$data["link"]}}>
        <button style="background:#77be53;border: none;padding: 10px;color: white;border-radius: 10px;">
            Reset Your Password
        </button>
    </a>
</body>
</html>