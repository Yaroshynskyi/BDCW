<?php
/** @var string $error_message */
?>
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="bi bi-palette-fill text-warning mb-2" style="font-size: 3rem;"></i>
                    <h3 class="fw-bold text-dark">Вхід до галереї</h3>
                    <p class="text-muted">Увійдіть, щоб керувати своєю колекцією</p>
                </div>

                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger rounded-3 border-0 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $error_message ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/virtualgallery/users/login">
                    <div class="mb-3">
                        <label for="login" class="form-label fw-bold small text-uppercase text-muted">Логін</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-secondary"></i></span>
                            <input type="text" class="form-control border-start-0 bg-light" id="login" name="login" required placeholder="Введіть ваш логін">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold small text-uppercase text-muted">Пароль</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-secondary"></i></span>
                            <input type="password" class="form-control border-start-0 bg-light" id="password" name="password" required placeholder="Введіть пароль">
                        </div>
                    </div>
                    <button type="submit" class="btn w-100 text-white rounded-pill py-2 shadow-sm mb-3" style="background-color: #D35400; font-weight: 600;">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Увійти
                    </button>
                    <div class="text-center">
                        <span class="text-muted small">Ще не маєте акаунту?</span>
                        <a href="/virtualgallery/users/register" class="text-decoration-none ms-1 fw-bold" style="color: #2C3E50;">Зареєструватися</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>