@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a class = "btn btn-primary" href = "{{ route(Auth::user()->perfil.'_index') }}">Voltar</a></div>

                @if($errors->any())
                    <div class="alert alert-danger mt-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header">Relatório de vagas para a sua área de atuação</div>

                <div class="card-body">
                <form action = "{{ route('resultado_candidato_area') }}">
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
