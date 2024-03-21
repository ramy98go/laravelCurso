@extends('dashboard.layout')

@section('content')

    <a href="{{ route("category.create") }}"> Crear </a>

    <table>
        <tr>
            <td>
                Titulo
            </td>
            <td>
                Acciones
            </td>
        </tr>
        <tbody>
            @foreach ($category as $p)
            <tr>
                <th>
                    {{ $p->title }}
                </th>
                <th>
                    <a href="{{ route("category.edit", $p) }}"> Editar </a>
                    <a href="{{ route("category.show", $p) }}"> Ver </a>

                    <form action="{{ route("category.destroy", $p) }}" method="POST">
                    @method("DELETE")
                    @csrf    
                        <button type="submit">Eliminar</button>

                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection