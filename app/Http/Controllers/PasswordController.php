<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\GeneratedPassword;
use App\Services\PasswordGenerator;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function destroy($id)
    {
        Password::where('user_id', auth()->id())
            ->findOrFail($id)
            ->delete();
        
        return response()->json(['success' => true]);
    }
    public function show($id)
{
    $password = Password::where('user_id', auth()->id())
        ->findOrFail($id);
    
    return response()->json($password);
}
    // Listar contraseñas
    public function index()
    {
        $passwords = Password::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json($passwords);
    }

    // Generar nueva contraseña
    public function generate(Request $request)
    {
        $password = PasswordGenerator::generate(
            length: (int) $request->input('length', 16),
            uppercase: $request->boolean('uppercase', true),
            lowercase: $request->boolean('lowercase', true),
            numbers: $request->boolean('numbers', true),
            symbols: $request->boolean('symbols', true)
        );

        // Guardar en historial
        GeneratedPassword::create([
            'user_id' => auth()->id(),
            'password_encrypted' => $password,
            'length' => (int) $request->input('length', 16),
            'has_uppercase' => $request->boolean('uppercase', true),
            'has_lowercase' => $request->boolean('lowercase', true),
            'has_numbers' => $request->boolean('numbers', true),
            'has_symbols' => $request->boolean('symbols', true),
        ]);

        return response()->json(['password' => $password]);
    }

    // Guardar contraseña en vault
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vault_id' => 'nullable|exists:vaults,id',
            'title' => 'required|string|max:255',
            'username' => 'nullable|string',
            'password' => 'required|string',
            'url' => 'nullable|url',
            'notes' => 'nullable|string',
        ]);

        $password = Password::create([
            'user_id' => auth()->id(),
            'vault_id' => $validated['vault_id'] ?? null,
            'title' => $validated['title'],
            'username' => $validated['username'] ?? null,
            'password_encrypted' => $validated['password'],
            'url' => $validated['url'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json($password, 201);
    }
}