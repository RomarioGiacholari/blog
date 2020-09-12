<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Romario Giacholari | Contact</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($name && $email && $messageData)
                    <h3>Email from {{ $name }} with email - {{ $email }}</h3>

                    <hr />

                    <p> {{ $messageData }} </p>
                @endif
            </div>
        </div>
    </div>
</body>

</html>