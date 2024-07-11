<?php

namespace App\Http\Controllers;

use App\Models\Apuesta;
use App\Models\Juego;
use Illuminate\Http\Request;

class ApuestaController extends Controller
{
    public function index()
    {
        $apuestas = Apuesta::all();
        $apuestas = Apuesta::with('juego')->get();
        $apuestasConMasDeTresJugadores = Apuesta::whereHas('juego', function($query) {
            $query->where('cantidad_jugadores', '<', 3);
        })->get();
        
        return view('apuestas.index', compact('apuestas', 'apuestasConMasDeTresJugadores'));
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
}
