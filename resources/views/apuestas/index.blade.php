@extends('layouts.app')

@section('title', 'Lista de Apuestas')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Lista de Apuestas</h1>

            <form action="{{ route('apuestas.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <select name="juego_id" id="juego_id" class="form-select">
                        <option value="">Seleccionar juego...</option>
                        @foreach($juegos as $juego)
                        <option value="{{ $juego->id }}" {{ request('juego_id') == $juego->id ? 'selected' : '' }}>{{ $juego->nombre }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>

            @if($apuestas->isEmpty())
                <p>No hay apuestas disponibles.</p>
            @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Juego</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apuestas as $apuesta)
                    <tr>
                        <td>{{ $apuesta->id }}</td>
                        <td>{{ $apuesta->juego->nombre }}</td>
                        <td>{{ $apuesta->fecha }}</td>
                        <td>{{ $apuesta->monto }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <h1>Lista de Apuestas con más de 3 Jugadores</h1>
            @if($apuestasConMasDeTresJugadores->isEmpty())
                <p>No hay apuestas con más de 3 jugadores disponibles.</p>
            @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Juego</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apuestasConMasDeTresJugadores as $apuesta)
                    <tr>
                        <td>{{ $apuesta->id }}</td>
                        <td>{{ $apuesta->juego->nombre }}</td>
                        <td>{{ $apuesta->fecha }}</td>
                        <td>{{ $apuesta->monto }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
