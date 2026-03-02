<nav class="navbar">
    <div class="container nav-wrapper">
        <a href="/" class="logo">e commerce</a>

        <div id="nav-content" class="nav-links">
            <span class="loading-text">Завантаження...</span>
        </div>
        @if(auth()->user()?->isAdmin())
            <a href="/admin" class="btn-link">Адмін Панель</a>
        @endif
    </div>
</nav>
