@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class = "row text-center">
                    <a href = "{{ route('nova_vaga') }}" class = "col-2 btn btn-primary">Criar vaga</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($vagas) > 0)
                        <table class = "table table-striped">
                            <thead>
                                <tr>
                                    <th>Área</th>
                                    <th>Cargo</th>
                                    <th class = "text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vagas as $vaga)
                                    <tr>
                                        <td>@if($vaga->cargo){{ $vaga->cargo->area->nome }}@else --- @endif</td>
                                        <td>@if($vaga->cargo){{ $vaga->cargo->nome }}@else --- @endif</td>
                                        <td><a style = "    margin-left: 30%; float: left;" class = "btn btn-warning" href = "{{ route('candidato_vaga') }}?id={{ $vaga->id }}">Candidatos</a>
                                        <a style = "float: left;" class = "btn btn-success" href = "{{ route('editar_vaga') }}?id={{ $vaga->id }}">Editar</a>
                                        <a style = "float: left;" class = "btn btn-danger" href = "{{ route('excluir_vaga') }}?id={{ $vaga->id }}">Excluir</a>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h4 class = "text-center">Não há vagas cadastradas!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
