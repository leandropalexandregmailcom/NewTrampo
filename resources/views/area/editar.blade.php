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
                    <form method="POST" action="{{ route('atualizar_area') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="cargo" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input value = "{{ $area->nome }}" id="nome" type="text" class="form-control " name="nome" value="{{ old('nome') }}" required autofocus>
                            </div>
                        </div>
                        <input type = "hidden" name = "id" value = "{{ $area->id_area }}">

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
