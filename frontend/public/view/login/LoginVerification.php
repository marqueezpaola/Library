<!-- LoginVerification.php -->
<section class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <img
                src="<?= $baseUrl ?>/assets/img/logo-biblioteca.png"
                alt="Escudo Biblioteca Roberto Ichazu"
                class="auth-logo"
            >
            <p class="auth-subtitle-small">HERMANO FELIPE PALAZÓN</p>
            <h1 class="auth-title">Biblioteca Roberto Ichazu</h1>
            <p class="auth-subtitle">Verifica tu código de seguridad.</p>
        </div>

        <p class="auth-description">
            Ingresa el código de verificación que enviamos a tu correo.
        </p>

        <form class="auth-form" method="post">
            <div class="auth-field">
                <label for="verification-code" class="auth-label">Código de verificación</label>
                <input
                    type="text"
                    id="verification-code"
                    name="code"
                    class="auth-input"
                    placeholder="Ej: 87264"
                    inputmode="numeric"
                >
            </div>

            <button type="submit" class="auth-button auth-button--primary" data-submit-main>
                VERIFICAR CÓDIGO
            </button>

            <div class="auth-extra-row auth-extra-row--center">
                <a href="#" class="auth-link auth-link--small">
                    Cambiar correo / reenviar código
                </a>
            </div>
        </form>
    </div>
</section>
