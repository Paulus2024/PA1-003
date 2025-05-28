@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')

<style>
    :root {
        --primary: #4361ee;
        --gray: #6c757d;
        --light-gray: #e9ecef;
    }

    body {
        font-family: "Cambria", Georgia, serif;
    }

    .message-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 10px;
    }

    .message-card {
        background: white;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        margin-bottom: 8px;
        border-left: 2px solid var(--primary);
        font-size: 13px;
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        padding: 6px 10px;
        border-bottom: 1px solid var(--light-gray);
    }

    .sender-info {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .sender-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 11px;
        flex-shrink: 0;
    }

    .sender-name {
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 120px;
    }

    .sender-email {
        color: var(--gray);
        font-size: 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 120px;
    }

    .message-time {
        color: var(--gray);
        font-size: 10px;
        white-space: nowrap;
    }

    .message-body {
        padding: 6px 10px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .message-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 4px 10px;
        border-top: 1px solid var(--light-gray);
    }

    .status-badge {
        font-size: 10px;
        padding: 1px 6px;
        border-radius: 8px;
    }

    .status-pending {
        background-color: #fff3cd;
    }

    .status-approved {
        background-color: #d4edda;
    }

    .btn-delete {
        background: none;
        border: none;
        color: #dc3545;
        padding: 1px 4px;
        font-size: 10px;
        cursor: pointer;
        font-family: "Cambria", Georgia, serif;
    }

    .page-title {
        font-size: 15px;
        margin: 12px 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .empty-state {
        text-align: center;
        padding: 20px 10px;
        font-size: 12px;
        color: var(--gray);
    }

    .alert {
        font-size: 11px;
        padding: 6px 10px;
        margin-bottom: 8px;
    }

    @media (max-width: 768px) {
        .sender-name, .sender-email {
            max-width: 80px;
        }
    }
</style>

<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<main id="main" class="main" style="margin-top: 65px;">
    <div class="message-container">
        <h5 class="page-title">
            <i class="bi bi-envelope" style="color: var(--primary);"></i>
            Pesan ({{ $allMessages->count() }})
        </h5>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.4rem;"></button>
            </div>
        @endif

        @forelse($allMessages as $msg)
            <div class="message-card">
                <div class="message-header">
                    <div class="sender-info">
                        <div class="sender-avatar">
                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="sender-name">{{ $msg->name }}</div>
                            <div class="sender-email">{{ $msg->email }}</div>
                        </div>
                    </div>
                    <div class="message-time">
                        {{ $msg->created_at->format('d M H:i') }}
                    </div>
                </div>

                <div class="message-body">
                    {{ $msg->message }}
                </div>

                <div class="message-footer">
                    <div>
                    </div>
                    <form action="{{ route('messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            ✕ Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="bi bi-envelope-open" style="font-size: 20px;"></i>
                <p class="mt-1">Tidak ada pesan</p>
            </div>
        @endforelse
    </div>
</main>

@endsection
