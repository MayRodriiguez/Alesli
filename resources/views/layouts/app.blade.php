<!DOCTYPE html>
<html lang="es" data-theme="{{ auth()->check() ? auth()->user()->theme : 'light' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alesli - Florería</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Tema CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- NAVEGACIÓN - Esto debe estar al principio, visible en la parte superior -->
    @include('layouts.navigation')
    
    <!-- CONTENIDO PRINCIPAL -->
    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Botón flotante para cambiar tema -->
    <button class="theme-toggle" onclick="toggleTheme()" id="themeToggleBtn">
        <i class="fas {{ auth()->check() && auth()->user()->theme == 'dark' ? 'fa-sun' : 'fa-moon' }}"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        const btn = document.getElementById('themeToggleBtn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        
        fetch('{{ route("theme.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.documentElement.setAttribute('data-theme', data.theme);
                localStorage.setItem('user_theme', data.theme);
                btn.innerHTML = '<i class="fas fa-' + (data.theme === 'dark' ? 'sun' : 'moon') + '"></i>';
            }
        })
        .catch(error => {
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('user_theme', newTheme);
            btn.innerHTML = '<i class="fas fa-' + (newTheme === 'dark' ? 'sun' : 'moon') + '"></i>';
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('user_theme');
        const userTheme = '{{ auth()->check() ? auth()->user()->theme : "light" }}';
        const themeToUse = savedTheme || userTheme || 'light';
        document.documentElement.setAttribute('data-theme', themeToUse);
        
        const btn = document.getElementById('themeToggleBtn');
        if (btn) {
            btn.innerHTML = '<i class="fas fa-' + (themeToUse === 'dark' ? 'sun' : 'moon') + '"></i>';
        }
    });
    </script>
    
    @stack('scripts')
</body>
</html>