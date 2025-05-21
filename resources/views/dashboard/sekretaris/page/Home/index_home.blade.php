@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<main class="main">
    <div class="container">
        <div class="welcome-container">
            <!-- Elegant Welcome Section -->
            <div class="welcome-content text-center">
                <div class="welcome-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" fill="#2c3e50" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>
                    </svg>
                </div>
                <h1 class="welcome-title">Selamat Bekerja</h1>
                <p class="welcome-subtitle">Sistem Informasi Sekretariat</p>

                <div class="datetime-container">
                    <div id="date" class="date-display"></div>
                    <div id="time" class="time-display"></div>
                </div>

                <div class="welcome-divider"></div>

                <p class="welcome-message">
                    Anda login sebagai <strong>Sekretaris</strong><br>
                    {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}
                </p>
            </div>
        </div>
    </div>
</main>

<style>
    body {
        font-family: 'Cambria', serif;
    }

    .welcome-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 2rem;
        background-color: #f8f9fa;
    }

    .welcome-content {
        max-width: 500px;
        width: 100%;
        background: white;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .welcome-icon {
        margin-bottom: 1.5rem;
    }

    .welcome-icon svg {
        transition: transform 0.3s ease;
    }

    .welcome-icon svg:hover {
        transform: scale(1.1);
    }

    .welcome-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
    }

    .welcome-subtitle {
        font-size: 1.2rem;
        color: #7f8c8d;
        margin-bottom: 2rem;
        font-style: italic;
    }

    .datetime-container {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.2rem;
        margin-bottom: 2rem;
        border: 1px solid #e9ecef;
    }

    .date-display {
        font-size: 1.2rem;
        color: #34495e;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .time-display {
        font-size: 2.4rem;
        font-weight: 600;
        color: #2c3e50;
        letter-spacing: 1.5px;
        font-family: 'Cambria', serif;
    }

    .welcome-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #ecf0f1, transparent);
        margin: 1.8rem auto;
        width: 120px;
    }

    .welcome-message {
        color: #7f8c8d;
        line-height: 1.6;
        font-size: 1.1rem;
    }

    .welcome-message strong {
        color: #2c3e50;
    }
</style>

<script>
    function updateDateTime() {
        const now = new Date();

        // Date display
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('date').innerHTML = now.toLocaleDateString('id-ID', dateOptions);

        // Time display
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
        document.getElementById('time').innerHTML = now.toLocaleTimeString('id-ID', timeOptions);
    }

    // Initial call
    updateDateTime();

    // Update every second
    setInterval(updateDateTime, 1000);
</script>
@endsection
