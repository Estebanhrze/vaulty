<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaulty - Password Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-900 via-purple-900 to-black min-h-screen">
    <nav class="p-6 flex justify-between items-center">
        <h1 class="text-white text-3xl font-bold">🔐 Vaulty</h1>
        <div class="space-x-4">
            <a href="/login" class="text-white hover:text-blue-300">Iniciar Sesión</a>
            <a href="/register" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Registrarse</a>
        </div>
    </nav>

    <main class="flex items-center justify-center min-h-[80vh]">
        <div class="text-center text-white max-w-3xl px-6">
            <div class="mb-8">
                <svg class="w-32 h-32 mx-auto mb-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke-width="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke-width="2"/>
                </svg>
            </div>
            
            <h1 class="text-6xl font-bold mb-6">Vaulty</h1>
            <p class="text-2xl mb-4">Tu bóveda personal de contraseñas</p>
            <p class="text-xl text-gray-300 mb-8">
                Genera, almacena y gestiona tus contraseñas de forma segura
            </p>
            
            <div class="flex gap-4 justify-center">
                <a href="/register" class="bg-blue-500 text-white px-8 py-3 rounded-lg text-lg hover:bg-blue-600 transition">
                    Comenzar Gratis
                </a>
                <a href="/login" class="bg-white/10 text-white px-8 py-3 rounded-lg text-lg hover:bg-white/20 transition">
                    Iniciar Sesión
                </a>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/10 p-6 rounded-lg">
                    <h3 class="text-xl font-bold mb-2">🔒 Seguro</h3>
                    <p class="text-gray-300">Encriptación de extremo a extremo</p>
                </div>
                <div class="bg-white/10 p-6 rounded-lg">
                    <h3 class="text-xl font-bold mb-2">🎲 Generador</h3>
                    <p class="text-gray-300">Contraseñas fuertes automáticas</p>
                </div>
                <div class="bg-white/10 p-6 rounded-lg">
                    <h3 class="text-xl font-bold mb-2">📁 Organizado</h3>
                    <p class="text-gray-300">Vaults para categorizar</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>