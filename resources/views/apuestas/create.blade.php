@extends('layouts.app')

@section('title', 'Crear Apuesta')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Crear Apuesta</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('apuestas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_juego">Juego</label>
                    <select name="id_juego" id="id_juego" class="form-control">
                        @foreach($juegos as $juego)
                        <option value="{{ $juego->id }}">{{ $juego->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="datetime-local" name="fecha" id="fecha" class="form-control">
                </div>
                <div class="form-group">
                    <label for="monto">Monto</label>
                    <input type="number" name="monto" id="monto" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>
</div>
@endsection
