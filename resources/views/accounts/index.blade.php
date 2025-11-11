<x-app-layout>
  <div class="max-w-4xl mx-auto p-6 space-y-4">
    <div class="flex justify-between items-center">
      <h1 class="text-xl font-semibold">Cuentas</h1>
      <a href="{{ route('accounts.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Nueva</a>
    </div>
    <div class="bg-white shadow rounded">
      <table class="w-full text-sm">
        <thead class="text-left text-gray-500">
          <tr><th class="p-3">Nombre</th><th>Tipo</th><th>Moneda</th><th class="text-right p-3">Balance</th><th class="p-3"></th></tr>
        </thead>
        <tbody>
          @forelse($accounts as $a)
            <tr class="border-t">
              <td class="p-3">{{ $a->name }}</td>
              <td>{{ $a->type }}</td>
              <td>{{ $a->currency }}</td>
              <td class="p-3 text-right">${{ number_format($a->current_balance,2) }}</td>
              <td class="p-3 text-right">
                <form method="POST" action="{{ route('accounts.destroy', $a) }}">
                  @csrf @method('DELETE')
                  <button class="text-red-600">Eliminar</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="p-3 text-gray-500">Sin cuentas</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
