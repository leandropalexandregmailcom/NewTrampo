@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Atualizar') }}</div>

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
                    <form method="POST" action="{{ route('atualizar_user') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input value = "{{ $Usuario->name }}" id="name" type="text" class="form-control " name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input value = "{{ $Usuario->email }}" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estado" class="col-md-4 col-form-label text-md-right">Estado</label>

                            <div class="col-md-6">
                                <input id="estado" type="text" class="form-control" value = "{{ $Usuario->name }}" name="estado" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cidade" class="col-md-4 col-form-label text-md-right">Cidade</label>

                            <div class="col-md-6">
                                <input value = "{{ $Usuario->endereco->cidade }}" id="cidade" type="text" class="form-control" value="{{ old('cidade') }}" name="cidade" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cep" class="col-md-4 col-form-label text-md-right" value="{{ old('cep') }}">CEP</label>

                            <div class="col-md-6">
                                <input value = "{{ $Usuario->endereco->cep }}" id="cep" type="numeric" min = "1" class="form-control" name="cep" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rua" class="col-md-4 col-form-label text-md-right" >Rua</label>

                            <div class="col-md-6">
                                <input value = "{{ $Usuario->endereco->rua }}" id="rua" type="text" class="form-control" name="rua" value="{{ old('rua') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numero" class="col-md-4 col-form-label text-md-right" >Número</label>

                            <div class="col-md-6">
                                <input value = "{{ $Usuario->endereco->numero }}" id="numero" type="numeric" min = "1" class="form-control" name="numero" value="{{ old('numero') }}" required>
                            </div>
                        </div>

                        @if(Auth::user()->perfil == 'candidato')
                        <div class="form-group row area">
                            <label for="area" class="col-md-4 col-form-label text-md-right" >Área</label>

                            <div class="col-md-6">
                                <select id="area" type="text" class="form-control" name="area" value="{{ old('area') }}">
                                    <option>Tecnologia da informação</option>
                                    <option>Culinária</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row profissao">
                            <label for="profissao" class="col-md-4 col-form-label text-md-right" >Profissão</label>

                            <div class="col-md-6">
                                <input value = "{{ $Usuario->candidato->profissao }}" id="profissao" type="text" class="form-control" name="profissao" value="{{ old('profissao') }}">
                            </div>
                        </div>
                        <div class="form-group row curriculo">
                            <label for="curriculo" class="col-md-4 col-form-label text-md-right" >currículo</label>

                            <div class="col-md-6">
                                <input id="curriculo" type="file" class="form-control" name="curriculo" value="{{ old('curriculo') }}">
                            </div>
                        </div>
                        <div class="form-group row apresentacao">
                            <label for="apresentacao" class="col-md-4 col-form-label text-md-right" >Apresentação</label>

                            <div class="col-md-6">
                                <textarea value = "{{ $Usuario->candidato->apresentacao }}" id="apresentacao" type="text" min = "25" limit = "255" class="form-control" name="apresentacao" value="{{ old('apresentacao') }}">
                                    {{ $Usuario->candidato->apresentacao }}
                                </textarea>
                            </div>
                        </div>
                        @else
                        <div class="form-group row cnpj">
                            <label for="cnpj" class="col-md-4 col-form-label text-md-right" >CNPJ</label>

                            <div class="col-md-6">
                                <input value = "{{ $Usuario->empresa->cnpj }}" id="cnpj" type="text" class="form-control" name="cnpj" value="{{ old('cnpj') }}">
                            </div>
                        </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Atualizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('change', '#perfil', function()
    {
        if($("#perfil").val() == 'candidato')
        {
            $(".area").css("display", "flex")
            $(".apresentacao").css("display", "flex")
            $(".curriculo").css("display", "flex")
            $(".profissao").css("display", "flex")
            $(".cnjp").css("display", "none")
        }
        else
        {
            $(".curriculo").css("display", "none")
            $(".apresentacao").css("display", "none")
            $(".area").css("display", "none")
            $(".profissao").css("display", "none")
            $(".cnpj").css("display", "flex")
        }
    })

    function f(x){
        var result = 3 * Math.pow(x, 2) - 2 * Math.pow(x, 2) + 4 * x - 1
        return result
    }

    function flinha(x){
        var result = 9 * Math.pow(x, 2) - 4 * x + 4
        return result
    }

    var x0 = 0
    var erro = Math.pow(10 , -6)
    var xi = 0
    var count = 0

    do{
        xi = x0 - f(x0) / flinha(x0)
        x0 = xi
        count++
    }while(Math.abs(f(xi)) > erro)

    console.log(xi)
    console.log(count)
</script>
@endsection
