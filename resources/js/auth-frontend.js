import {Api} from './api.js'

$(document).ready(function() {
    checkAuthState();

    if ($('#login-form').length) {
        $('#login-form').on('submit', async function (e) {
            e.preventDefault();

            const btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true).text('Завантаження...');

            try {
                const res = await Api.post(`/login`, {
                    email: $('#l-email').val(),
                    password: $('#l-password').val()
                });

                localStorage.setItem('at', res.token);

                if(res?.user?.role === 0) {
                    window.location.href = '/admin';
                } else {
                    window.location.href = '/profile';
                }

            } catch (err) {
                btn.prop('disabled', false).text('Увійти');
                $('.error-msg').text('');

                const errorData = err.responseJSON;

                if (errorData?.errors) {
                    Object.keys(errorData.errors).forEach(key => {
                        $(`#error-r-${key}`).text(errorData.errors[key][0]);
                    });
                } else {
                    console.error(err)
                    console.log(errorData?.message || 'Помилка сервера');
                }
            }
        });
    }

    if ($('#register-form').length) {
        $('#register-form').on('submit', async function(e) {
            e.preventDefault();

            const btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true).text('Завантаження...');

            try {
                const res = await Api.post(`/register`, {
                    name: $('#r-name').val(),
                    email: $('#r-email').val(),
                    password: $('#r-password').val(),
                    password_confirmation: $('#r-confirm').val()
                });

                localStorage.setItem('at', res.token);
                sessionStorage.removeItem('user_cache');

                btn.addClass('btn-success').text('Реєстрація успішна!');

                setTimeout(() => {
                    window.location.href = '/profile';
                }, 1500);
            } catch (err) {
                btn.prop('disabled', false).text('Створити аккаунт');
                $('.error-msg').text('');

                const errorData = err.responseJSON;

                if (errorData?.errors) {
                    Object.keys(errorData.errors).forEach(key => {
                        $(`#error-r-${key}`).text(errorData.errors[key][0]);
                    });
                } else {
                    console.error(err)
                    console.log(errorData?.message || 'Помилка сервера');
                }
            }

        });
    }
});

async function checkAuthState() {
    const token = localStorage.getItem('at');
    const nav = $('#nav-content');
    const path = window.location.pathname;

    if (!token) {
        nav.html(`
            <a href="/login" class="btn-link">Увійти</a>
            <a href="/register" class="btn-link btn-link-primary">Реєстрація</a>
        `);
        return;
    }

    let user = JSON.parse(sessionStorage.getItem('user_cache'));

    if(!user) {
        try {
            user = await Api.get(`/user`);
            sessionStorage.setItem('user_cache', JSON.stringify(user));
        } catch (err) {
            localStorage.removeItem('at');

            if (window.location.pathname !== '/login') {
                location.reload();
            }
        }
    }

    if (path.startsWith('/admin')) {
        if (user.role === 0) {
            $('#admin-gate').show();
        } else {
            $('#access-denied').show();
        }
    }

    nav.html(`
        <div class="user-nav-group">
            <a href="/profile" class="nav-user-name">${user.name}</a>
            <button onclick="logout()" class="btn-logout">Вийти</button>
        </div>
    `);


    const roleBadge = $('#user-role-badge');

    if(user.role === 0) {
        roleBadge
            .text('Адміністратор');
    } else {
        roleBadge
            .text('Клієнт');
    }
}

window.logout = async function() {
    const logoutBtn = $('.btn-logout');
    logoutBtn.text('Вихід...');

    try {
        await Api.post('/logout');
    } catch (err) {
        console.warn('Server logout failed, clearing local session anyway.', err);
    } finally {
        localStorage.removeItem('at');
        sessionStorage.removeItem('user_cache');

        window.location.href = '/login';
    }
};

async function refreshToken() {
    const oldToken = localStorage.getItem('at');
    try {
        const res = await Api.post(`/refresh`);

        localStorage.setItem('at', res.token);
        console.log('Token rotated successfully.');
        return res.token;
    } catch (err) {
        localStorage.removeItem('at');
        location.reload();
    }
}

window.logout = logout;
