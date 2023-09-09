@extends('aplicacion')
@section('contenido')
<section class="hero is-primary is-bold is-fullheight">
    <div class="hero-body is-justify-content-center">
        <div id="wrapper-centered">
            @if( $errors->any() )
            <div class="notification is-danger has-text-centered">
                <strong>Usuario ó contraseña incorrectos</strong>
            </div>
            @endif

            <div class="box has-text-centered pb-5" style="min-width: 400px">
                <div class="title">
                    <img src="{{ asset('images/mvn-favicon-b.png') }}" width="36" height="36" />
                    <span class="has-text-dark ml-1">KONTROL</span>
                </div>
    
                <form action="{{ route('autenticar.attempt') }}" method="post" autocomplete="off">
                    <div class="field">
                        <div class="control">
                            <input type="text" class="input" name="usuario" value="{{ old('usuario') }}" placeholder="Usuario" required autofocus />
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input type="password" class="input" name="contrasena" placeholder="Contraseña" required />
                        </div>
                    </div>
                    <button class="button is-primary is-fullwidth">
                        <b>ENTRAR</b>
                    </button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
