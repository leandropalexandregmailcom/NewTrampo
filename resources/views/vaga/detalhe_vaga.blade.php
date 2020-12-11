@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a class = "btn btn-primary" href = "{{ route(Auth::user()->perfil.'_index') }}">Voltar</a></div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger mt-5">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('criar_vaga') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label value = "{{ $vaga->nome }}" for="name" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>

                            <div class="col-md-6">
                                <select id="area" type="text" class="form-control " name="area" value="{{ old('area') }}" required autofocus>
                                    <option value = "1">
                                        Tecnologia da informação
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cargo" class="col-md-4 col-form-label text-md-right">{{ __('Cargo') }}</label>

                            <div class="col-md-6">
                                <input value = "{{ $vaga->cargo->nome }}" id="cargo" type="text" class="form-control " name="cargo" value="{{ old('cargo') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="validade" class="col-md-4 col-form-label text-md-right">{{ __('Validade') }}</label>

                            <div class="col-md-6">
                                <input value = "{{ $vaga->validade }}" id="validade" type="date" class="form-control " name="validade" value="{{ old('validade') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                            <div class="col-md-6">
                                <textarea value = "{{ $vaga->descricao }}" id="descricao" type="text" class="form-control " name="descricao" value="{{ old('descricao') }}" required autofocus>
                                    {{ $vaga->descricao }}
                                </textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
