<!DOCTYPE html>
<html>
<head>
    <title>Voiceline App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Voiceline</a>
        </div>
    </nav>

    <main class="container">
        {{-- This is where page-specific content will be injected --}}
        @yield('content')
    </main>
</body>
</html>
