@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                <div class = "row text-center">
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
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vagas as $vaga)
                                    <tr>
                                        <td>{{ $vaga->cargo->area->nome }}</td>
                                        <td>{{ $vaga->cargo->nome }}</td>
                                        <td><a id = "candidatar" class = "btn btn-primary" href = "{{ route('candidatar_vaga') }}?id_vaga={{ $vaga->id }}">Candidatar-se</a>
                                            <a href = "{{ route('detalhe_vaga') }}?id_vaga={{ $vaga->id }}" class = "btn btn-warning">Detalhes</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h4 class = "text-center">Por enquanto não há vagas para o seu perfil!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
@endsection
