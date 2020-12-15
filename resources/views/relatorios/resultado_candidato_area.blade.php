@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a class = "btn btn-primary" href = "{{ route(Auth::user()->perfil.'_index') }}">Voltar</a></div>

                <div class="card-header">Dashboard</div>

                @if(count($resultado) > 0)
                    @php
                        $count = 1;
                    @endphp
                    <table class = "table table-striped">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Cargo</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultado as $result)
                                <tr>
                                    <td>{{ $count }}</td>
                                    @if($result->cargo)
                                    <td> {{  $result->cargo->nome   }} </td>
                                    @else
                                    <td> ---  </td>
                                    @endif
                                    <td>{{ date('d/m/Y', strtotime($result->create_date)) }}
                                    </td>
                                </tr>
                                @php
                                    $count++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    {{ $resultado->links() }}
                    @else
                    <h4 class = "text-center h4">Sem resultados</h4>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
