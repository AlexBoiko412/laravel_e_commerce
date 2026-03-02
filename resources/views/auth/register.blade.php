@extends('layouts.app')

@section('title', 'Реєстрація')

@section('content')
    <div class="container">
        <form
            id="register-form"
            class="auth-card"
        >
            <h2>Реєстрація</h2>

            <div class="form-group">
                <input
                    type="text"
                    id="r-name"
                    placeholder="Ім'я"
                    class="input-field"
                >
                <span class="error-msg" id="error-r-name"></span>
            </div>
            <div class="form-group">
                <input
                    type="email"
                    id="r-email"
                    placeholder="Email"
                    class="input-field"
                >
                <span class="error-msg" id="error-r-email"></span>
            </div>
            <div class="form-group">
                <input
                    type="password"
                    id="r-password"
                    placeholder="Пароль"
                    class="input-field"
                >
                <span class="error-msg" id="error-r-password"></span>
            </div>
            <div class="form-group">
                <input
                    type="password"
                    id="r-confirm"
                    placeholder="Підтвердіть пароль"
                    class="input-field"
                >
                <span class="error-msg" id="error-r-password-confirm"></span>
            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Створити акаунт
            </button>

            <p
                class="text-muted form-bottom-text"
            >
                Вже є акаунт?

                <a
                    class="link"
                    href="{{ route('login') }}"
                >
                    Увійти
                </a>
            </p>
        </form>
    </div>
@endsection
