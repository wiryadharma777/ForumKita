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
  <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
  <link rel="stylesheet" type="text/css" href="/css/trix.css">
  {{-- <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script> --}}
  <script type="text/javascript" src="/js/trix.js"></script>

  {{-- Custom CSS --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
  
  @include('layout.header')
  
  <main class="flex flex-1 px-6 py-8 max-w-7xl mx-auto gap-6">
    @include('layout.sidebar')
    
    @yield('content')
  </main>

  @include('layout.footer')

  {{-- Sweetalert V2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>