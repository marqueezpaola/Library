<!-- LoginPassword.php -->
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
            <p class="auth-subtitle">Recuperar contraseña</p>
        </div>

        <p class="auth-description">
            Ingresa tu correo electrónico. Te enviaremos un código de verificación para recuperar tu contraseña.
        </p>

        <form class="auth-form" method="post">
            <div class="auth-field">
                <label for="recovery-email" class="auth-label">Correo electrónico</label>
                <input
                    type="email"
                    id="recovery-email"
                    name="email"
                    class="auth-input"
                    placeholder="tucorreo@ejemplo.com"
                    autocomplete="email"
                >
            </div>

            <button type="submit" class="auth-button auth-button--primary" data-submit-main>
                ENVIAR CÓDIGO
            </button>

            <div class="auth-extra-row auth-extra-row--center">
                <a
                    href="<?= $baseUrl ?>/pages/auth/login.php"
                    class="auth-link auth-link--small"
                >
                    Volver al inicio de sesión
                </a>
            </div>
        </form>
    </div>
</section>
