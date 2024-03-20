@extends('dashboard.layout')

@section('content')
    
    <a href="{{ route("post.create") }}"> Crear </a>


    <table>
        <tr>
            <td>
                Titulo
            </td>
            <td>
                Categoria
            </td>
            <td>
                Posted
            </td>
            <td>
                Acciones
            </td>
        </tr>
        <tbody>
            @foreach ($posts as $p)
            <tr>
                <th>
                    {{ $p->title }}
                </th>
                <th>
                    {{ $p->category->title }}
                </th>
                <th>
                    {{ $p->posted }}
                </th>
                <th>
                    <a href="{{ route("post.edit", $p) }}"> Editar </a>
                    <a href="{{ route("post.show", $p) }}"> Ver </a>

                    <form action="{{ route("post.destroy", $p) }}" method="POST">
                    @method("DELETE")
                    @csrf    
                        <button type="submit">Eliminar</button>

                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}

@endsection