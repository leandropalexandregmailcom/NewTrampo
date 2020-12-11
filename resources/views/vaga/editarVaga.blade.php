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
                    <form method="POST" action="{{ route('atualizar_vaga') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>

                            <div class="col-md-6">
                                <select id="area" type="text" class="form-control " name="area" value="{{ old('area') }}" required autofocus>
                                    @foreach($areas as $area)
                                        <option value = "{{ $area->id_area }}" @if($vaga->area == $area->id_area) selected @endif>
                                            {{ $area->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cargo" class="col-md-4 col-form-label text-md-right">{{ __('Cargo') }}</label>

                            <div class="col-md-6">
                                <input id="cargo" type="text" class="form-control " name="cargo" value="{{ $vaga->cargo->nome }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="validade" class="col-md-4 col-form-label text-md-right">{{ __('Validade') }}</label>

                            <div class="col-md-6">
                                <input id="validade" type="date" class="form-control " name="validade" value="{{ $vaga->validade }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <input type = "hidden" name = "id" value = "{{ $vaga->id }}">
                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                            <div class="col-md-6">
                                <textarea id="descricao" type="text" class="form-control " name="descricao" required autofocus>
                                    {{ $vaga->descricao }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Atualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
