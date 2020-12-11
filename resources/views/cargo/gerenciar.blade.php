@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class = "btn btn-primary" href = "{{ route('novo_cargo') }}">Criar cargo</a>
            <div class="card">
                <div class="card-header"><a class = "btn btn-primary" href = "{{ route(Auth::user()->perfil.'_index') }}">Voltar</a></div>

                @if(count($cargo) > 0)
                <table class = "table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Área</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cargo as $item)
                            <tr>
                                <td>{{ $item->nome }}</td>
                                <td>{{ $item->area->nome }}</td>
                                <td>
                                    <a style = "float: left;" class = "btn btn-warning" href = "{{ route('editar_cargo') }}?id={{ $item->id_cargo }}">Editar</a>
                                    <a style = "float: left;" class = "btn btn-danger" href = "{{ route('excluir_cargo') }}?id={{ $item->id_cargo }}">Excluir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $cargo->links() }}
                @else
                <h4 class = "text-center">Não há cargo cadastrado!</h4>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
