<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistema Académico' }}</title>
    <!-- Tailwind CSS desde CDN para diseño inmediato -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen text-gray-800">

    <!-- Barra Superior de Navegación -->
    <nav class="bg-indigo-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <span class="font-bold text-lg tracking-wide">🎓 Sistema Académico</span>
            </div>
            
            <div class="hidden md:flex space-x-6 text-sm font-medium">
                <a href="{{ route('estudiantes.index', request()->route('current_team')) }}" class="hover:text-indigo-200 transition">Estudiantes</a>
                <a href="{{ route('profesores.index', request()->route('current_team')) }}" class="hover:text-indigo-200 transition">Profesores</a>
                <a href="{{ route('cursos.index', request()->route('current_team')) }}" class="hover:text-indigo-200 transition">Cursos</a>
                <a href="{{ route('acudientes.index', request()->route('current_team')) }}" class="hover:text-indigo-200 transition">Acudientes</a>
                <a href="{{ route('grados.index', request()->route('current_team')) }}" class="hover:text-indigo-200 transition">Grados</a>
                <a href="{{ route('areas.index', request()->route('current_team')) }}" class="hover:text-indigo-200 transition">Áreas</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Notificaciones de éxito -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Errores de validación -->
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html