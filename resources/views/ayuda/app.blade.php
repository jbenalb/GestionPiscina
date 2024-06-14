<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda de la Aplicación - PoolBook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .nav-container {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-container a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card, .faq {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px 0;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card-header, .faq-header {
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }
        .card-body, .faq-body {
            display: none;
            padding-top: 10px;
        }
        .btn-liquid {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
        .btn-liquid:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="nav-container">
        @auth
            <a href="{{ url('/dashboard') }}" style="text-decoration: none; color: #fff; margin-right: auto; margin-left: 10px;">
                {{ Auth::user()->name }}
            </a>
        @endauth
        <div class="flex items-center">
            <a href="{{ url('/home') }}" class="home">Home</a>
            @auth
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout" style="background: none; border: none; color: white; cursor: pointer;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="login">Log in</a>
            @endauth
        </div>
    </div>

    <div class="container">
        <h1>Ayuda</h1>
        <p>Aquí puedes encontrar información sobre cómo usar la aplicación PoolBook.</p>

        <div class="card">
            <div class="card-header" onclick="toggleCardBody('reservationsCard')">Crear reservas</div>
            <div class="card-body" id="reservationsCard">
                <p>Crea y elimina tus reservas fácilmente desde el calendario.</p>
                <video width="600" controls>
                    <source src="{{ asset('videos/Crear y eliminar cita.mp4') }}" type="video/mp4">
                    Tu navegador no soporta la reproducción de videos.
                </video>
            </div>
        </div>

        <div class="card">
            <div class="card-header" onclick="toggleCardBody('calendarCard')">Ver Reservas</div>
            <div class="card-body" id="calendarCard">
                <p>Muestra tus reservas.</p>
                <video width="600" controls>
                    <source src="{{ asset('videos/Ver Reservas.mp4') }}" type="video/mp4">
                    Tu navegador no soporta la reproducción de videos.
                </video>
            </div>
        </div>

        <a href="{{ url('/help') }}" class="btn-liquid">
            Volver a Ayuda
        </a>
    </div>

    <!-- Nueva sección para Preguntas Frecuentes -->
    <div class="container">
        <h1>Preguntas Frecuentes</h1>
        <div class="faq">
            <div class="faq-header" onclick="toggleFaqBody('faq1')">¿Cuántas citas puedo crear por día?</div>
            <div class="faq-body" id="faq1">
                <p>Solo se puede crear una cita por dia.</p>
            </div>
        </div>

        <div class="faq">
            <div class="faq-header" onclick="toggleFaqBody('faq2')">¿Puede algún usuario eliminar mi cita?</div>
            <div class="faq-body" id="faq2">
                <p>Solo el usuario administrador puede eliminar tu cita.</p>
            </div>
        </div>

        <div class="faq">
            <div class="faq-header" onclick="toggleFaqBody('faq3')">¿Qué debo hacer si encuentro un error en la aplicación?</div>
            <div class="faq-body" id="faq3">
                <p>Si encuentras un error en la aplicación, por favor, contacta con nuestro equipo de soporte enviando un correo a soporte@poolbook.com.</p>
            </div>
        </div>
    </div>

    <script>
        function toggleCardBody(cardId) {
            const cardBody = document.getElementById(cardId);
            if (cardBody.style.display === "none" || cardBody.style.display === "") {
                cardBody.style.display = "block";
            } else {
                cardBody.style.display = "none";
            }
        }
        
        function toggleFaqBody(faqId) {
            const faqBody = document.getElementById(faqId);
            if (faqBody.style.display === "none" || faqBody.style.display === "") {
                faqBody.style.display = "block";
            } else {
                faqBody.style.display = "none";
            }
        }
    </script>
</body>
</html>