<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ForumKita @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- Icon --}}
    <link rel="icon" href="/img/favicon.png" type="image/png">

    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    
    @include('layout.header-v2')
    
    <main class="flex flex-1">
    @include('layout.sidebar-v2')
    
    @yield('content')
    </main>   

    {{-- Sweetalert V2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>