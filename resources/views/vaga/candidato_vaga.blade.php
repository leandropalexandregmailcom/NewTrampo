@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card-header">
                <a class = "btn btn-primary" href = "{{ route(Auth::user()->perfil.'_index') }}">Voltar</a>
            </div>
            <div class="card">
                @if(count($lista) > 0)
                <table class = "table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Profissão</th>
                            <th>Currículo</th>
                            <th class = "text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($lista as $list)
                            @if($list->candidato)
                                <tr>
                                    <td>{{ $list->candidato->name }}</td>
                                    <td>{{ $list->candidato->email }}</td>
                                    <td>{{ $list->candidato->candidato->profissao }}</td>
                                    <td><a href = "">Currículo</a></td>
                                    <td>
                                        <select id = "estado" name = "estado" class = "form-control">
                                            @foreach($estados as $estado)
                                                <option @if($list->estado == $estado->id_estado) selected @endif value = "{{ $estado->id_estado }}_{{ $list->id_candidato }}_{{ $list->vaga->id }}">
                                                    {{ $estado->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{ $lista->links() }}
                @else
                <h4 class = "text-center">Não há usuários cadastrados!</h4>
            @endif
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('change', '#estado', function(data)
    {
        var val = $(this).val().split('_')
        id_estado = val[0]
        id_candidato = val[1]
        id_vaga = val[2]

        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url : 'mudar_estado',
            type: 'get',
            data: {id_estado : id_estado,  id_vaga: id_vaga, id_candidato: id_candidato}
        }).done(function(response)
        {
            window.location.reload()
        }).fail(function(response)
        {
            console.log(response)
        })
    })

</script>
@endsection
