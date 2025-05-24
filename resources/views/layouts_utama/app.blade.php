<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>e-Katalog UMKM Bondowoso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    @include('partials.navbar')
    <main class="min-h-screen">@yield('content')</main>
    @include('partials.footer')
</body>
</html>