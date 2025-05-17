<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ZayShop - Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap @5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css "
        integrity="sha512-pV1grrTcuMcDJ+2x7Aj2fYKj6FbHjbHkQXvc+1ddbsGzD7AURWlPn5slE6 + más estilos"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Estilos personalizados -->
    @stack('styles')
</head>

<body class="bg-light">

    <div class="d-flex">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <!-- Navbar superior -->
            @include('admin.partials.navbar')

            <!-- Breadcrumbs -->
            @isset($breadcrumbs)
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    @foreach ($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item">
                        @if(isset($breadcrumb['url']))
                        <a href="{{ $breadcrumb['url'] }}" class="text-decoration-none">{{ $breadcrumb['name'] }}</a>
                        @else
                        {{ $breadcrumb['name'] }}
                        @endif
                    </li>
                    @endforeach
                </ol>
            </nav>
            @endisset

            <!-- Mensajes flash -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Contenido dinámico -->
            @yield('content')
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap @5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>

</html>