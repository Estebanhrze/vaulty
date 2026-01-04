<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔐 {{ __('Password Vault') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Generador de Contraseñas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">🎲 Generar Contraseña</h2>
                    
                    <form id="generateForm" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block mb-2">Longitud: <span id="lengthValue">16</span></label>
                            <input type="range" name="length" min="8" max="64" value="16" 
                                   class="w-full" oninput="document.getElementById('lengthValue').innerText = this.value">
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="uppercase" checked class="mr-2">
                                Mayúsculas (A-Z)
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="lowercase" checked class="mr-2">
                                Minúsculas (a-z)
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="numbers" checked class="mr-2">
                                Números (0-9)
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="symbols" checked class="mr-2">
                                Símbolos (!@#$...)
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                            Generar
                        </button>
                    </form>

                    <div id="generatedPassword" class="mt-4 hidden">
                        <div class="bg-gray-100 p-4 rounded flex justify-between items-center">
                            <code id="passwordDisplay" class="font-mono text-lg break-all"></code>
                            <button onclick="copyPassword()" class="bg-green-500 text-white px-3 py-1 rounded text-sm ml-2">
                                Copiar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Guardar Contraseña -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">💾 Guardar Contraseña</h2>
                    
                    <form id="saveForm" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block mb-2">Título *</label>
                            <input type="text" name="title" required 
                                   class="w-full border rounded px-3 py-2" placeholder="Gmail, Netflix...">
                        </div>

                        <div>
                            <label class="block mb-2">Usuario/Email</label>
                            <input type="text" name="username" 
                                   class="w-full border rounded px-3 py-2" placeholder="usuario@ejemplo.com">
                        </div>

                        <div>
                            <label class="block mb-2">Contraseña *</label>
                            <input type="password" name="password" required 
                                   class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block mb-2">URL</label>
                            <input type="url" name="url" 
                                   class="w-full border rounded px-3 py-2" placeholder="https://...">
                        </div>

                        <div>
                            <label class="block mb-2">Notas</label>
                            <textarea name="notes" rows="3" 
                                      class="w-full border rounded px-3 py-2"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                            Guardar
                        </button>
                    </form>
                </div>

                <!-- Lista de Contraseñas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:col-span-2">
                    <h2 class="text-xl font-bold mb-4">🔑 Mis Contraseñas</h2>
                    <div id="passwordsList"></div>
                </div>

            </div>
        </div>
    </div>

    <script>
    // Generar contraseña
    document.getElementById('generateForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        
        const response = await fetch('/passwords/generate', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        document.getElementById('passwordDisplay').textContent = data.password;
        document.getElementById('generatedPassword').classList.remove('hidden');
    });

    // Copiar contraseña
    function copyPassword() {
        const password = document.getElementById('passwordDisplay').textContent;
        navigator.clipboard.writeText(password);
        alert('¡Contraseña copiada!');
    }

    // Guardar contraseña
    document.getElementById('saveForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        
        const response = await fetch('/passwords', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });
        
        if (response.ok) {
            alert('¡Contraseña guardada!');
            e.target.reset();
            loadPasswords();
        }
    });

    // Cargar lista de contraseñas
    async function loadPasswords() {
        const response = await fetch('/passwords');
        const passwords = await response.json();
        
        const html = passwords.map(p => `
            <div class="border-b py-3 flex justify-between items-center">
                <div>
                    <h3 class="font-bold">${p.title}</h3>
                    <p class="text-sm text-gray-600">${p.username || 'Sin usuario'}</p>
                </div>
                <button onclick="showPassword(${p.id})" 
                        class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                    Ver
                </button>
            </div>
        `).join('');
        
        document.getElementById('passwordsList').innerHTML = html || '<p class="text-gray-500">No hay contraseñas guardadas</p>';
    }

    // Cargar al inicio
    loadPasswords();

    // Mostrar contraseña 
    async function showPassword(id) {
        const response = await fetch(`/passwords/${id}`);
        const password = await response.json();
        
        alert(`
    Título: ${password.title}
    Usuario: ${password.username || 'N/A'}
    Contraseña: ${password.password_encrypted}
    URL: ${password.url || 'N/A'}
    Notas: ${password.notes || 'N/A'}
        `);
    }
    </script>
</x-app-layout> 