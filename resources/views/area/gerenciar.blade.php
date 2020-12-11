@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a class = "btn btn-primary" href = "{{ route(Auth::user()->perfil.'_index') }}">Voltar</a></div>

                @if(count($areas) > 0)
                <table class = "table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th><a class = "btn btn-primary" href = "{{ route('nova_area') }}">Criar área</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($areas as $item)
                            <tr>
                                <td>{{ $item->nome }}</td>
                                <td>
                                    <a style = "float: left;" class = "btn btn-warning" href = "{{ route('editar_area') }}?id={{ $item->id_area }}">Editar</a>
                                    <a style = "float: left;" class = "btn btn-danger" href = "{{ route('excluir_area') }}?id={{ $item->id_area }}">Excluir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $areas->links() }}
                @else
                <h4 class = "text-center">Não há area cadastradas!</h4>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
