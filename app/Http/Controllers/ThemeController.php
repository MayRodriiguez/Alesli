<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ThemeController extends Controller
{
    /**
     * Alternar entre modo oscuro y claro
     */
    public function toggle(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no autenticado'
            ], 401);
        }
        
        $newTheme = $user->theme === 'dark' ? 'light' : 'dark';
        $user->theme = $newTheme;
        $user->save();
        
        return response()->json([
            'success' => true,
            'theme' => $newTheme
        ]);
    }
    
    /**
     * Establecer un tema específico
     */
    public function set(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark'
        ]);
        
        /** @var User $user */
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no autenticado'
            ], 401);
        }
        
        $user->theme = $request->theme;
        $user->save();
        
        return response()->json([
            'success' => true,
            'theme' => $user->theme
        ]);
    }
}