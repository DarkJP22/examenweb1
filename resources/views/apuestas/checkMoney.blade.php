@extends('layouts.app')

@section('title', 'Chequeo de Dinero de Apuestas')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Chequeo de Dinero de Apuestas</h1>
            <p>Total Dinero en Juegos de Cartas: {{ $moneyCartas }}</p>
            <p>Total Dinero en Juegos que No Son de Cartas: {{ $moneyNoCartas }}</p>
            @if ($result)
                <p>El dinero total en apuestas de juegos de cartas es mayor que en los juegos que no son de cartas.</p>
            @else
                <p>El dinero total en apuestas de juegos de cartas no es mayor que en los juegos que no son de cartas.</p>
            @endif
        </div>
    </div>
</div>
@endsection
