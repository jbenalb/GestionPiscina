@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('menu-admin.css') }}">

    <div class="container2">
        <!-- Menú -->
        <aside>
            <p>Menu</p>
            <a href="{{ route('calendario') }}">
                <i class="fa fa-user-o" aria-hidden="true"></i>
                Calendario
            </a>
            <a href="{{ route('reservas.index') }}">
                <i class="fa fa-user-o" aria-hidden="true"></i>
                Reservas
            </a>
            <a href="{{ route('admin.index') }}">
                <i class="fa fa-clone" aria-hidden="true"></i>
                Usuarios
            </a>
            <a href="{{ route('register') }}">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                Crear usuario 
            </a>
            
            <a href="{{ route('admin.users.create') }}">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                Crear usuario admin
            </a>
            
            <a href="{{ route('perfil') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                Ver Perfil
            </a>
            @auth
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
    </aside>
        </aside>
        
        <!-- Contenido del dashboard y cuadros de métricas -->
        <div class="content">
            <div class="dashboard">
                <!-- Contenido del dashboard -->
            </div>
            
            <!-- Cuadros de métricas -->
            <div class="metrics">
                <!-- Primer cuadro -->
                <div class="info-box">
                    <h3>Total de Citas</h3>
                    <p>{{ $totalCitas }}</p>
                </div>
                
                <!-- Segundo cuadro -->
                <div class="info-box">
                    <h3>Total de Usuarios</h3>
                    <p>{{ $totalUsuarios }}</p>

                </div>
                
                
            </div>
            
        </div>
    </div>
   
@endsection
