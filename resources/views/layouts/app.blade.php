<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas - Organize sua Vida</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados para tornar a aplicação mais bonita */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .card-shadow {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .btn-hover {
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .task-item {
            transition: all 0.3s ease;
        }
        
        .task-item:hover {
            transform: translateX(5px);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                📝 Lista de Tarefas
            </h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-white text-center py-6 mt-12">
        <p class="text-sm opacity-75">© 2025 Lista de Tarefas - Desenvolvido com Laravel 10</p>
    </footer>
</body>
</html>
