<?php

namespace App\Http\Controllers;

use App\Models\Apuesta;
use App\Models\Juego;
use Illuminate\Http\Request;

class ApuestaController extends Controller
{
    public function index(Request $request)
    {
        $apuestas = Apuesta::all();
        
        $apuestasConMasDeTresJugadores = Apuesta::whereHas('juego', function ($query) {
            $query->where('cantidad_jugadores', '<', 3);
        })->get();

        $juegos = Juego::all();

        $juegoId = $request->input('juego_id');
        if ($juegoId) {
            $juego = Juego::findOrFail($juegoId);
            $apuestas = Apuesta::where('id_juego', $juegoId)->get();
        }

        return view('apuestas.index', [
            'apuestas' => $apuestas,
            'apuestasConMasDeTresJugadores' => $apuestasConMasDeTresJugadores,
            'juegos' => $juegos, 
        ]);
    }


    public function create()
    {
        $juegos = Juego::all();
        return view('apuestas.create', compact('juegos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_juego' => 'required|exists:juegos,id',
            'fecha' => 'required|date',
            'monto' => 'required|integer',
        ]);

        Apuesta::create($request->all());

        return redirect()->route('apuestas.index');
    }

    public function filterByPlayers()
    {
        $apuestas = Apuesta::whereHas('juego', function($query) {
            $query->where('cantidad_jugadores', '>', 3);
        })->get();

        return view('apuestas.index', compact('apuestas'));
    }

    public function checkMoney()
    {
        $moneyCartas = Apuesta::whereHas('juego', function($query) {
            $query->where('juego_de_cartas', true);
        })->sum('monto');

        $moneyNoCartas = Apuesta::whereHas('juego', function($query) {
            $query->where('juego_de_cartas', false);
        })->sum('monto');

        $result = $moneyCartas > $moneyNoCartas;

        return view('apuestas.checkMoney', compact('result', 'moneyCartas', 'moneyNoCartas'));
    }

    public function filterByGame($id_juego)
    {
        $apuestas = Apuesta::where('id_juego', $id_juego)->get();
        return view('apuestas.index', compact('apuestas'));
    }

    public function search(Request $request)
    {
        $juego = $request->input('juego');

        // Realizar la búsqueda en la base de datos
        $apuestas = Apuesta::whereHas('juego', function ($query) use ($juego) {
            $query->where('nombre', 'like', '%' . $juego . '%');
        })->get();

        return view('apuestas.index', [
            'apuestas' => $apuestas,
            // Pasa otras variables necesarias a la vista si es necesario
        ]);
    }
}
