@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')

<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #4a6fa5;
        --success-color: #27ae60;
        --warning-color: #f39c12;
        --light-bg: #f8fafc;
        --border-color: #eaeef2;
    }

    body {
        font-family: "Cambria", Georgia, serif;
        color: var(--primary-color);
        background-color: #f5f7fa;
    }

    .message-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .message-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 20px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .message-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        background-color: var(--light-bg);
        border-bottom: 1px solid var(--border-color);
    }

    .sender-info {
        display: flex;
        align-items: center;
    }

    .sender-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--secondary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-weight: bold;
    }

    .sender-details {
        line-height: 1.4;
    }

    .sender-name {
        font-weight: 600;
        color: var(--primary-color);
    }

    .sender-email {
        color: #7f8c8d;
        font-size: 0.85rem;
    }

    .message-time {
        color: #95a5a6;
        font-size: 0.85rem;
    }

    .message-body {
        padding: 20px 24px;
        line-height: 1.7;
        border-bottom: 1px solid var(--border-color);
    }

    .message-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 24px;
        background-color: white;
    }

    .status-badge {
        font-size: 0.8rem;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
    }

    .status-pending {
        background-color: rgba(243, 156, 18, 0.1);
        color: var(--warning-color);
    }

    .status-approved {
        background-color: rgba(39, 174, 96, 0.1);
        color: var(--success-color);
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        font-size: 0.85rem;
        padding: 6px 14px;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.2s;
        border: none;
    }

    .btn-approve {
        background-color: var(--success-color);
        color: white;
    }

    .btn-approve:hover {
        background-color: #219955;
    }

    .btn-delete {
        background-color: #f8f9fa;
        color: #e74c3c;
        border: 1px solid #eaeef2;
    }

    .btn-delete:hover {
        background-color: #f1f3f5;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .empty-icon {
        font-size: 3rem;
        color: #bdc3c7;
        margin-bottom: 15px;
    }

    .empty-text {
        color: #7f8c8d;
        font-size: 1.1rem;
    }

    .page-title {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-title .badge {
        background-color: var(--secondary-color);
        color: white;
        font-size: 0.9rem;
        padding: 4px 10px;
        border-radius: 20px;
    }
</style>

<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<main id="main" class="main" style="margin-top: 100px;">
    <div class="message-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">
                <i class="bi bi-envelope-fill"></i>
                Pesan Masuk
                <span class="badge">{{ $allMessages->count() }}</span>
            </h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
                 style="border-left: 4px solid var(--success-color);">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @forelse($allMessages as $msg)
            <div class="message-card">
                <div class="message-header">
                    <div class="sender-info">
                        <div class="sender-avatar">
                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                        </div>
                        <div class="sender-details">
                            <div class="sender-name">{{ $msg->name }}</div>
                            <div class="sender-email">{{ $msg->email }}</div>
                        </div>
                    </div>
                    <div class="message-time">
                        {{ $msg->created_at->format('d M Y, H:i') }}
                    </div>
                </div>

                <div class="message-body">
                    <p>{{ $msg->message }}</p>
                </div>

                <div class="message-footer">
                    <div>
                        @if($msg->is_approved)
                            <span class="status-badge status-approved">
                                <i class="bi bi-check-circle-fill me-1"></i> Disetujui
                            </span>
                        @else
                            <span class="status-badge status-pending">
                                <i class="bi bi-clock-fill me-1"></i> Menunggu Persetujuan
                            </span>
                        @endif
                    </div>
                    <div class="action-buttons">
                        @if(!$msg->is_approved)
                        @endif
                            <form action="{{ route('messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-envelope-open"></i>
                </div>
                <h4 class="empty-text">Belum ada pesan masuk</h4>
                <p class="text-muted">Semua pesan yang masuk akan muncul di sini</p>
            </div>
        @endforelse
    </div>
</main>

@endsection
