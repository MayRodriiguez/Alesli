<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asistencia;
use App\Models\Personal;
use App\Models\Producto;

class PersonalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $personal = Personal::where('email', $user->email)->first();
        
        if (!$personal) {
            return redirect()->route('home')->with('error', 'No se encontró tu información de personal');
        }
        
        // Asistencia de hoy
        $asistenciaHoy = Asistencia::where('personal_id', $personal->id)
            ->whereDate('fecha', today())
            ->first();
        
        // Asistencia de la semana
        $asistenciaSemana = Asistencia::where('personal_id', $personal->id)
            ->whereBetween('fecha', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('fecha', 'desc')
            ->get();
        
        // Estadísticas
        $totalDias = Asistencia::where('personal_id', $personal->id)->count();
        $diasPresente = Asistencia::where('personal_id', $personal->id)
            ->whereIn('estado', ['presente', 'tarde'])
            ->count();
        $diasAusente = $totalDias - $diasPresente;
        $horasTrabajadas = Asistencia::where('personal_id', $personal->id)
            ->whereNotNull('hora_entrada')
            ->whereNotNull('hora_salida')
            ->count() * 8; // Aproximado
        
        return view('personal.dashboard', compact('personal', 'asistenciaHoy', 'asistenciaSemana', 
                    'totalDias', 'diasPresente', 'diasAusente', 'horasTrabajadas'));
    }

    public function marcarEntrada()
    {
        $user = Auth::user();
        $personal = Personal::where('email', $user->email)->first();
        
        if (!$personal) {
            return back()->with('error', 'No se encontró tu información');
        }
        
        $existeHoy = Asistencia::where('personal_id', $personal->id)
            ->whereDate('fecha', today())
            ->exists();

        if ($existeHoy) {
            return back()->with('error', 'Ya registraste entrada hoy');
        }

        $asistencia = new Asistencia();
        $asistencia->personal_id = $personal->id;
        $asistencia->fecha = today();
        $asistencia->hora_entrada = now();
        
        $horaLimite = '09:15:00';
        if (now()->format('H:i:s') > $horaLimite) {
            $asistencia->estado = 'tarde';
            $mensaje = '⏰ Entrada registrada (Llegaste tarde)';
        } else {
            $asistencia->estado = 'presente';
            $mensaje = '✅ Entrada registrada correctamente';
        }
        
        $asistencia->save();

        return back()->with('success', $mensaje);
    }

    public function marcarSalida()
    {
        $user = Auth::user();
        $personal = Personal::where('email', $user->email)->first();
        
        if (!$personal) {
            return back()->with('error', 'No se encontró tu información');
        }
        
        $asistencia = Asistencia::where('personal_id', $personal->id)
            ->whereDate('fecha', today())
            ->first();

        if (!$asistencia) {
            return back()->with('error', 'Primero debes registrar tu entrada');
        }

        if ($asistencia->hora_salida) {
            return back()->with('error', 'Ya registraste tu salida hoy');
        }

        $asistencia->hora_salida = now();
        $asistencia->save();

        return back()->with('success', '✅ Salida registrada correctamente');
    }

    public function inventario()
    {
        $productos = Producto::all();
        return view('personal.inventario', compact('productos'));
    }
    
    public function miPerfil()
    {
        $user = Auth::user();
        $personal = Personal::where('email', $user->email)->first();
        return view('personal.perfil', compact('personal'));
    }
    
    public function updatePerfil(Request $request)
    {
        $user = Auth::user();
        $personal = Personal::where('email', $user->email)->first();
        
        $request->validate([
            'telefono' => 'required|string|max:15',
        ]);
        
        $personal->telefono = $request->telefono;
        $personal->save();
        
        return back()->with('success', 'Perfil actualizado correctamente');
    }
}