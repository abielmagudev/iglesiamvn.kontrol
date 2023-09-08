<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="container">
    <div class="navbar-brand">
      <div class="navbar-item">
        <img src="{{ asset('images/mvn-favicon-b.png') }}" width="28" height="28" class="mr-2" style="vertical-align:baseline">
        <b class="is-size-4">KONTROL</b>
      </div>
  
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
  
    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item" href="{{ route('escritorio.index') }}">
          Escritorio
        </a>

        <a class="navbar-item" href="{{ route('miembros.index') }}">
          Miembros
        </a>
  
        <a class="navbar-item" href="{{ route('ministerios.index') }}">
          Ministerios
        </a>

        <a class="navbar-item" href="{{ route('eventos.index') }}">
          Eventos
        </a>

        <a class="navbar-item" href="{{ route('visitas.index') }}">
          Visitas
        </a>

        <a class="navbar-item" href="{{ route('usuarios.index') }}">
          Usuarios
        </a>
      </div>
  
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons is-justify-content-flex-end">
            <a class="button is-white" href="{{ route('autenticado.edit') }}">
              <x-icons.user-solid />
              <span>{{ auth()->user()->name }}</span>
            </a>
            <div class="is-hidden-desktop is-clearfix"></div>
            <a class="button is-danger" href="{{ route('autenticar.logout') }}">
              <span>Salir</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
