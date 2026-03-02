@extends('layouts.app')

@section('title', 'Вхід')

@section('content')
    <div class="container">
        <form
            id="login-form"
            class="auth-card"
        >
            <h2>Вхід</h2>

            <div class="form-group">
                <input
                    type="email"
                    id="l-email"
                    placeholder="Email"
                    class="input-field"
                    value="admin@example.com"
                >
                <span class="error-msg" id="error-r-email"></span>
            </div>
            <div class="form-group">
                <input
                    type="password"
                    id="l-password"
                    placeholder="Пароль"
                    class="input-field"
                    value="password"
                >
                <span class="error-msg" id="error-r-password"></span>
            </div>
            <button
                type="submit"
                class="btn btn-primary"
            >
                Увійти
            </button>
            <p class="text-muted form-bottom-text">
                Немає акаунту?
                <a
                    class="link"
                    href="{{ route('register') }}"
                >Зареєструватися</a>
            </p>
        </form>
    </div>
@endsection
