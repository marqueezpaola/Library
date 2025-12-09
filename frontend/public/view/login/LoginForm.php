<!-- LoginForm.php -->
<section class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <img
                src="<?= $logoUrl ?>"
                alt="Escudo Biblioteca Roberto Ichazu"
                class="auth-logo"
            >

            <p class="auth-subtitle-small">HERMANO FELIPE PALAZÓN</p>

            <h1 class="auth-title">Biblioteca Roberto Ichazu</h1>

            <p class="auth-subtitle">Ingresa tus datos para continuar.</p>
        </div>

        <div class="auth-alert auth-alert--success auth-alert--hidden" id="login-success-msg">
            Tu contraseña ha sido actualizada. Ahora puedes iniciar sesión con tu nueva contraseña.
        </div>

        <form class="auth-form" method="post">
            <div class="auth-field">
                <label for="username" class="auth-label">Nombre de usuario</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="auth-input"
                    placeholder="Tu nombre de usuario"
                    autocomplete="username"
                >
            </div>

            <div class="auth-field">
                <label for="email" class="auth-label">Correo electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="auth-input"
                    placeholder="tucorreo@ejemplo.com"
                    autocomplete="email"
                >
            </div>

            <div class="auth-field auth-field--password">
                <label for="password" class="auth-label">Contraseña</label>

                <div class="auth-input-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="auth-input auth-input--password"
                        placeholder="Ingresa tu contraseña"
                        autocomplete="current-password"
                        data-password-input
                    >
                    <button
                        type="button"
                        class="auth-input-toggle"
                        data-toggle-password
                        aria-label="Mostrar u ocultar contraseña"
                    >
                        👁
                    </button>
                </div>
            </div>

            <div class="auth-extra-row">
                <a href="<?= $baseUrl ?>/pages/auth/login.php?step=forgot" class="auth-link auth-link--small">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <button type="submit" class="auth-button auth-button--primary" data-submit-main>
                INICIAR SESIÓN
            </button>

            <div class="auth-divider">
                <span class="auth-divider__line"></span>
                <span class="auth-divider__text">o</span>
                <span class="auth-divider__line"></span>
            </div>

            <button type="button" class="auth-button auth-button--google">
                <span class="auth-button__icon">
                    <span class="auth-google-g">G</span>
                </span>
                <span class="auth-button__text">
                    Continuar con Google
                </span>
            </button>
        </form>
    </div>
</section>
