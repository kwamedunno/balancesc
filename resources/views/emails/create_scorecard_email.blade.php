{{-- <p>Hello {{ $data_createcard['staffname'] }}</p>
<p>This is a message from the Balanced ScoreCard Application</p>
<p>Your scorecard for the month of {{ $data_createcard['month'] }} {{ $data_createcard['year'] }} has been created.</p>
<p>Please checkout your score card at this link >> <a href="https://scorecard.instntmny.com/"> Balanced ScoreCard </a></p> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {!! $mailStructure["body"] !!}
</body>
</html>