@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a style = "width: 20%;" class = "btn btn-primary col-5" href = "{{ route('gerenciar_area') }}">Gerenciar área</a>
            <a style = "width: 20%;" class = "btn btn-secondary col-5" href = "{{ route('gerenciar_cargo') }}">Gerenciar cargo</a>

            <div class="card">
                @if(count($user) > 0)

                <table class = "table-responsive table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th>
                                Opções
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->perfil }}</td>
                                <td>
                                    <a class = "btn btn-danger" href = "{{ route('excluir_usuario') }}?id={{ $usuario->id }}">Excluir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $user->links() }}
                @else
                <h4 class = "text-center">Não há user cadastradas!</h4>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
