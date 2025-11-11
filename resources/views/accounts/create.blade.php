<x-app-layout>
  <div class="max-w-lg mx-auto p-6">
    <h1 class="text-xl font-semibold mb-4">Nueva cuenta</h1>

    <form method="POST" action="{{ route('accounts.store') }}" class="space-y-4 bg-white p-5 shadow rounded">
      @csrf
      <div>
        <label class="block text-sm text-gray-600">Nombre</label>
        <input name="name" class="w-full border rounded p-2" required>
        @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm text-gray-600">Tipo</label>
        <input name="type" placeholder="checking / savings / credit" class="w-full border rounded p-2" required>
        @error('type') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-sm text-gray-600">Moneda</label>
          <input name="currency" value="USD" class="w-full border rounded p-2" required>
          @error('currency') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="block text-sm text-gray-600">Balance inicial</label>
          <input name="initial_balance" type="number" step="0.01" value="0" class="w-full border rounded p-2" required>
          @error('initial_balance') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
      </div>

      <div class="flex justify-end gap-2">
        <a href="{{ route('accounts.index') }}" class="px-3 py-2">Cancelar</a>
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Crear</button>
      </div>
    </form>
  </div>
</x-app-layout>
