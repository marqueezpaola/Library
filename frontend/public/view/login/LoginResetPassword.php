<!-- LoginResetPassword.php -->
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
            <p class="auth-subtitle">Crea una nueva contraseña.</p>
        </div>

        <div class="auth-alert auth-alert--success auth-alert--hidden" id="reset-success-msg">
            Código verificado correctamente. Ahora puedes crear una nueva contraseña.
        </div>

        <div class="auth-alert auth-alert--error auth-alert--hidden" id="reset-error-msg">
            La nueva contraseña debe tener al menos 6 caracteres.
        </div>

        <p class="auth-description">
            Crea una nueva contraseña para tu cuenta.
        </p>

        <form class="auth-form" method="post">
            <div class="auth-field auth-field--password">
                <label for="new-password" class="auth-label">Nueva contraseña</label>
                <div class="auth-input-wrapper">
                    <input
                        type="password"
                        id="new-password"
                        name="new_password"
                        class="auth-input auth-input--password"
                        placeholder="Nueva contraseña"
                        autocomplete="new-password"
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

            <div class="auth-field auth-field--password">
                <label for="confirm-password" class="auth-label">Confirmar contraseña</label>
                <div class="auth-input-wrapper">
                    <input
                        type="password"
                        id="confirm-password"
                        name="confirm_password"
                        class="auth-input auth-input--password"
                        placeholder="Repite la nueva contraseña"
                        autocomplete="new-password"
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

            <button type="submit" class="auth-button auth-button--primary" data-submit-main>
                GUARDAR NUEVA CONTRASEÑA
            </button>

            <div class="auth-extra-row auth-extra-row--center">
                <a href="#" class="auth-link auth-link--small">
                    Volver al inicio de sesión
                </a>
            </div>
        </form>
    </div>
</section>
