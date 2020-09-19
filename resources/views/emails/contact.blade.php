<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Romario Giacholari | Contact</title>
</head>

<body>
    <div>
        @if($name && $email && $messageData)
            <p> {{ sprintf('Email from (%s) with email (%s)', $name, $email) }} </p>
            <p> {{ sprintf('Message: %s', $messageData) }} </p>
        @endif
    </div>
</body>
</html>