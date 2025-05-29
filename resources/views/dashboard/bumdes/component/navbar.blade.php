<div class="sidebar position-fixed" id="sidebar">
    <div class="sidebar-header">
        <a href="/index_bumdes" class="sidebar-brand">
            <div class="brand-text">
                <h5>Selamat Datang BUMDES</h5>
            </div>
        </a>
        <button class="sidebar-toggle" onclick="toggleSidebar(this)">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <!-- Menu Items -->
    <nav class="sidebar-nav">
        <a href="/index_bumdes" class="{{ Request::is('index_bumdes') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Home</span>
        </a>
        <a href="/alat_pertanian_bumdes" class="{{ Request::is('alat_pertanian_bumdes') ? 'active' : '' }}">
            <i class="bi bi-tools"></i>
            <span>Alat Pertanian</span>
        </a>
    </nav>

    <!-- Account Section -->
    <div class="sidebar-footer">
        @auth
        <div class="user-menu">
            <a href="#" class="user-profile" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i>
                <span>BUMDES</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="dropdown-menu">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        @else
        <a href="/login" class="{{ Request::is('login') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Login</span>
        </a>
        @endauth
    </div>
</div>

<style>
    /* Font Family */
    .sidebar,
    .sidebar * {
        font-family: "Cambria", Georgia, serif !important;
    }

    /* Color Variables */
    :root {
        --sidebar-bg: #1a365d;
        --sidebar-active: #2c5282;
        --sidebar-hover: #2a4365;
        --sidebar-text: #ebf8ff;
        --sidebar-icon: #90cdf4;
    }

    /* Sidebar Base Styles */
    .sidebar {
        width: 260px;
        height: 100vh;
        background: var(--sidebar-bg);
        color: var(--sidebar-text);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    /* Sidebar Header */
    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        color: var(--sidebar-text);
        text-decoration: none;
    }

    .brand-text h5 {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }

    .sidebar-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: var(--sidebar-icon);
        cursor: pointer;
        font-size: 1.2rem;
    }

    /* Navigation Links */
    .sidebar-nav {
        flex: 1;
        padding: 15px 0;
        overflow-y: auto;
    }

    .sidebar-nav a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: var(--sidebar-text);
        text-decoration: none;
        transition: all 0.2s;
        margin: 2px 10px;
        border-radius: 4px;
        font-size: 0.95rem;
    }

    .sidebar-nav a i {
        margin-right: 12px;
        color: var(--sidebar-icon);
        font-size: 1rem;
        width: 20px;
        text-align: center;
    }

    .sidebar-nav a:hover {
        background: var(--sidebar-hover);
    }

    .sidebar-nav a.active {
        background: var(--sidebar-active);
        font-weight: 600;
    }

    /* Footer Section */
    .sidebar-footer {
        padding: 15px 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-menu {
        position: relative;
    }

    .user-profile {
        display: flex;
        align-items: center;
        color: var(--sidebar-text);
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 4px;
        transition: all 0.2s;
        font-size: 0.95rem;
    }

    .user-profile:hover {
        background: var(--sidebar-hover);
    }

    .user-profile i:first-child {
        margin-right: 12px;
        font-size: 1.1rem;
    }

    .user-profile i:last-child {
        margin-left: auto;
        font-size: 0.8rem;
    }

    .dropdown-menu {
        background: var(--sidebar-bg);
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        min-width: 100%;
    }

    .dropdown-item {
        color: var(--sidebar-text);
        padding: 8px 16px;
        font-size: 0.9rem;
    }

    .dropdown-item:hover {
        background: var(--sidebar-hover);
    }

    /* Collapsed State */
    .sidebar-collapsed {
        width: 70px;
    }

    .sidebar-collapsed .brand-text,
    .sidebar-collapsed .sidebar-nav a span,
    .sidebar-collapsed .user-profile span,
    .sidebar-collapsed .user-profile i:last-child {
        display: none;
    }

    .sidebar-collapsed .sidebar-toggle i {
        transform: rotate(180deg);
    }

    .sidebar-collapsed .sidebar-nav a {
        justify-content: center;
        padding: 12px 0;
    }

    .sidebar-collapsed .sidebar-nav a i {
        margin-right: 0;
        font-size: 1.1rem;
    }
</style>

<script>
    function toggleSidebar(button) {
        const sidebar = document.getElementById('sidebar');
        const isCollapsed = sidebar.classList.toggle('sidebar-collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);

    }

    // Initialize sidebar state
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const button = document.querySelector('.sidebar-toggle');

        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('sidebar-collapsed');
        }
    });
</script>
