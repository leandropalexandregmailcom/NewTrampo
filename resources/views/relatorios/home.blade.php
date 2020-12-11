@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($errors->any())
                    <div class="alert alert-danger mt-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header"><a class = "btn btn-primary" href = "{{ route(Auth::user()->perfil.'_index') }}">Voltar</a></div>

                <div class="card-header">Candidato/Vaga</div>

                <div class="card-body">
                <form action = "{{ route('resultado_candidato_vaga') }}">
                    <div class="form-group row curriculo">
                            <label class="col-md-4 col-form-label text-md-right" >Data inicial</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="inicial" value="{{ old('inicial') }}">
                            </div>
                        </div>
                        <div class="form-group row curriculo">
                            <label class="col-md-4 col-form-label text-md-right" >Data final</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="final" value="{{ old('final') }}">
                            </div>
                        </div>

                        <div class="form-group row curriculo">
                            <label for="curriculo" class="col-md-4 col-form-label text-md-right" >Vaga</label>

                            <div class="col-md-6">
                                <select class="form-control" name="vaga">
                                    <option value = "todas">Todas</option>
                                    @foreach($vagas as $vaga)
                                        <option value = "{{ $vaga->id }}">{{ $vaga->cargo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                       <div class="col-md-6 offset-md-4">
                            <button class =" btn btn-primary">Filtrar</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
