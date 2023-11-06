<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <title>{{env('APP_NAME','Clinic')}}</title>
    <link rel="stylesheet" href="{{ asset('storage/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/app.css') }}">
</head>

<body>
    <div class="container-fluid">
        <main>
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('storage/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
