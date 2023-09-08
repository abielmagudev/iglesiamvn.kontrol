@extends('aplicacion')
@section('contenido')
<x-card :title="sprintf('Usuarios (%s)', $usuarios->count())">
    <x-slot name="options">
        <a href="{{ route('usuarios.create') }}" class="button is-link is-small">
            <x-icons.plus />
        </a>
    </x-slot>

    @if( $usuarios->count() )
    <x-table class="is-fullwidth is-hoverable">
        @slot('head')
        <tr>
            <th>Correo electrónico</th>
            <th>Usuario</th>
            <th></th>
        </tr>
        @endslot

        @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->name }}</td>
            <td class="has-text-right">
                <a href="{{ route('usuarios.edit', $usuario) }}" class="button is-small is-warning is-outlined has-text-dark">Editar</a>
            </td>
        </tr>
        @endforeach
    </x-table>

    @else
    <p class="has-text-centered">Agrega más usuarios...</p>

    @endif
</x-card>
@endsection
