<boltArtifact id="dashboard-complete" title="Dashboard Completo Ordenado">
<boltAction type="file" filePath="resources/views/dashboard.blade.php">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔐 {{ __('Password Vault') }}
        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        
        <!-- Tarjetas superiores: Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Contraseñas</p>
                        <p id="totalPasswords" class="text-3xl font-bold text-gray-900">0</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Contraseñas Débiles</p>
                        <p id="weakPasswords" class="text-3xl font-bold text-red-600">0</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Seguridad Promedio</p>
                        <p id="avgSecurity" class="text-3xl font-bold text-green-600">Fuerte</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Generador de Contraseñas -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Generar Contraseña</h3>
                </div>
            </div>
            
            <form id="generateForm" class="p-6 space-y-4">
                @csrf
                
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-medium text-gray-700">Longitud</label>
                        <span id="lengthValue" class="text-sm font-bold text-blue-600">16</span>
                    </div>
                    <input type="range" name="length" min="8" max="64" value="16" 
                           class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider" 
                           oninput="document.getElementById('lengthValue').innerText = this.value">
                </div>

                <div class="space-y-3">
                    <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" name="uppercase" checked class="w-4 h-4 text-blue-600 rounded">
                        <span class="ml-3 text-sm font-medium text-gray-700">Mayúsculas (A-Z)</span>
                    </label>
                    <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" name="lowercase" checked class="w-4 h-4 text-blue-600 rounded">
                        <span class="ml-3 text-sm font-medium text-gray-700">Minúsculas (a-z)</span>
                    </label>
                    <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" name="numbers" checked class="w-4 h-4 text-blue-600 rounded">
                        <span class="ml-3 text-sm font-medium text-gray-700">Números (0-9)</span>
                    </label>
                    <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                        <input type="checkbox" name="symbols" checked class="w-4 h-4 text-blue-600 rounded">
                        <span class="ml-3 text-sm font-medium text-gray-700">Símbolos (!@#$...)</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition shadow-lg">
                    🎲 Generar Contraseña
                </button>
            </form>

            <div id="generatedPassword" class="px-6 pb-6 hidden">
                <div class="bg-gradient-to-r from-green-50 to-blue-50 p-4 rounded-lg border border-green-200">
                    <p class="text-xs text-gray-600 mb-2">Contraseña generada:</p>
                    <div class="flex items-center justify-between gap-2">
                        <code id="passwordDisplay" class="font-mono text-sm font-bold text-gray-900 break-all flex-1"></code>
                        <button onclick="copyPassword()" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition whitespace-nowrap">
                            📋 Copiar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guardar Contraseña -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Nueva Contraseña</h3>
                </div>
            </div>
            
            <form id="saveForm" class="p-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                        <input type="text" name="title" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                               placeholder="Gmail, Netflix, Banco...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Usuario/Email</label>
                        <input type="text" name="username" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                               placeholder="usuario@ejemplo.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña *</label>
                        <input type="password" name="password" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                               placeholder="••••••••">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL</label>
                        <input type="url" name="url" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                               placeholder="https://ejemplo.com">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notas</label>
                    <textarea name="notes" rows="2" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none" 
                              placeholder="Información adicional..."></textarea>
                </div>

                <button type="submit" class="mt-4 w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 rounded-lg font-semibold hover:from-green-700 hover:to-green-800 transition shadow-lg">
                    💾 Guardar Contraseña
                </button>
            </form>
        </div>
</div>
        <!-- Lista de Contraseñas -->
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">Mis Contraseñas</h3>
            </div>
            <input type="text" id="searchBox" placeholder="Buscar..." class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
    </div>
    <div id="passwordsList" class="divide-y divide-gray-200"></div>
</div>

    </div>
</div>

<!-- Modal para ver contraseña -->
<div id="passwordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900" id="modalTitle"></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="text-sm font-medium text-gray-600">Usuario</label>
                <p id="modalUsername" class="text-gray-900 font-medium"></p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600">Contraseña</label>
                <div class="flex items-center gap-2">
                    <p id="modalPassword" class="text-gray-900 font-mono bg-gray-50 p-2 rounded flex-1 break-all"></p>
                    <button onclick="copyModalPassword()" class="bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700">
                        Copiar
                    </button>
                </div>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600">URL</label>
                <a id="modalUrl" href="#" target="_blank" class="text-blue-600 hover:underline block break-all"></a>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600">Notas</label>
                <p id="modalNotes" class="text-gray-900"></p>
            </div>
        </div>
        <div class="p-6 border-t border-gray-200 flex gap-3">
            <button onclick="deletePassword()" class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700">
                Eliminar
            </button>
            <button onclick="closeModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400">
                Cerrar
            </button>
        </div>
    </div>
</div>

<script>
let currentPasswordId = null;
let allPasswords = [];

// Función para verificar si una contraseña es débil
function isWeakPassword(password) {
    if (!password || password.length < 8) return true;
    
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumbers = /[0-9]/.test(password);
    const hasSymbols = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    
    const strength = [hasUpperCase, hasLowerCase, hasNumbers, hasSymbols].filter(Boolean).length;
    
    return strength < 3 || password.length < 12;
}

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

// Copiar contraseña generada
function copyPassword() {
    const password = document.getElementById('passwordDisplay').textContent;
    navigator.clipboard.writeText(password);
    alert('✅ Contraseña copiada al portapapeles');
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
        alert('✅ Contraseña guardada exitosamente');
        e.target.reset();
        loadPasswords();
    }
});

// Cargar lista de contraseñas
async function loadPasswords() {
    const response = await fetch('/passwords');
    allPasswords = await response.json();
    
    document.getElementById('totalPasswords').textContent = allPasswords.length;
    
    // Contar contraseñas débiles
    let weakCount = 0;
    for (const p of allPasswords) {
        const detailResponse = await fetch(`/passwords/${p.id}`);
        const detail = await detailResponse.json();
        if (isWeakPassword(detail.password_encrypted)) {
            weakCount++;
        }
    }
    document.getElementById('weakPasswords').textContent = weakCount;
    
    // Calcular seguridad promedio
    const avgSecurityText = document.getElementById('avgSecurity');
    if (allPasswords.length > 0) {
        const weakPercentage = (weakCount / allPasswords.length) * 100;
        if (weakPercentage > 50) {
            avgSecurityText.textContent = 'Débil';
            avgSecurityText.className = 'text-3xl font-bold text-red-600';
        } else if (weakPercentage > 25) {
            avgSecurityText.textContent = 'Media';
            avgSecurityText.className = 'text-3xl font-bold text-yellow-600';
        } else {
            avgSecurityText.textContent = 'Fuerte';
            avgSecurityText.className = 'text-3xl font-bold text-green-600';
        }
    }
    
    renderPasswords(allPasswords);
}

// Renderizar contraseñas
function renderPasswords(passwords) {
    const html = passwords.map(p => `
        <div class="p-4 hover:bg-gray-50 transition cursor-pointer" onclick="showPassword(${p.id})">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-12 h-12 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                        ${p.title.charAt(0).toUpperCase()}
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">${p.title}</h4>
                        <p class="text-sm text-gray-600">${p.username || 'Sin usuario'}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-xs text-gray-500">${new Date(p.created_at).toLocaleDateString()}</span>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
        </div>
    `).join('');
    
    document.getElementById('passwordsList').innerHTML = html || '<p class="p-6 text-center text-gray-500">No hay contraseñas guardadas</p>';
}

// Buscar contraseñas
document.getElementById('searchBox').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    
    if (searchTerm === '') {
        renderPasswords(allPasswords);
    } else {
        const filtered = allPasswords.filter(p => 
            p.title.toLowerCase().includes(searchTerm) || 
            (p.username && p.username.toLowerCase().includes(searchTerm))
        );
        renderPasswords(filtered);
    }
});

// Mostrar contraseña en modal
async function showPassword(id) {
    currentPasswordId = id;
    const response = await fetch(`/passwords/${id}`);
    const password = await response.json();
    
    document.getElementById('modalTitle').textContent = password.title;
    document.getElementById('modalUsername').textContent = password.username || 'N/A';
    document.getElementById('modalPassword').textContent = password.password_encrypted;
    document.getElementById('modalUrl').textContent = password.url || 'N/A';
    document.getElementById('modalUrl').href = password.url || '#';
    document.getElementById('modalNotes').textContent = password.notes || 'Sin notas';
    
    document.getElementById('passwordModal').classList.remove('hidden');
}

// Cerrar modal
function closeModal() {
    document.getElementById('passwordModal').classList.add('hidden');
    currentPasswordId = null;
}

// Copiar contraseña del modal
function copyModalPassword() {
    const password = document.getElementById('modalPassword').textContent;
    navigator.clipboard.writeText(password);
    alert('✅ Contraseña copiada');
}

// Eliminar contraseña
async function deletePassword() {
    if (!confirm('¿Estás seguro de eliminar esta contraseña?')) return;
    
    await fetch(`/passwords/${currentPasswordId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
    });
    
    closeModal();
    loadPasswords();
    alert('✅ Contraseña eliminada');
}

// Cargar al inicio
loadPasswords();
</script>
</x-app-layout>
</boltAction>
</boltArtifact>