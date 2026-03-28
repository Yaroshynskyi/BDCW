<?php
/** @var string $error_message */
?>
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="bi bi-person-plus-fill mb-2" style="font-size: 3rem; color: #2C3E50;"></i>
                    <h3 class="fw-bold text-dark">Новий поціновувач мистецтва</h3>
                    <p class="text-muted">Приєднуйтесь до нашої спільноти</p>
                </div>

                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger rounded-3 border-0 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($error_message) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/virtualgallery/users/register">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label fw-bold small text-uppercase text-muted">Ім'я</label>
                            <input type="text" class="form-control bg-light border-0 shadow-sm" id="firstName" name="firstname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label fw-bold small text-uppercase text-muted">Прізвище</label>
                            <input type="text" class="form-control bg-light border-0 shadow-sm" id="lastName" name="lastname" required>
                        </div>
                        <div class="col-12">
                            <label for="login" class="form-label fw-bold small text-uppercase text-muted">Логін <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light border-0 shadow-sm" id="login" name="login" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-bold small text-uppercase text-muted">Пароль <span class="text-danger">*</span></label>
                            <input type="password" class="form-control bg-light border-0 shadow-sm" id="password" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirm" class="form-label fw-bold small text-uppercase text-muted">Підтвердження <span class="text-danger">*</span></label>
                            <input type="password" class="form-control bg-light border-0 shadow-sm" id="password_confirm" name="password2" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn w-100 text-white rounded-pill py-2 shadow-sm mt-4 mb-3" style="background-color: #2C3E50; font-weight: 600;">
                        <i class="bi bi-check-circle me-2"></i>Створити акаунт
                    </button>
                    
                    <div class="text-center">
                        <span class="text-muted small">Вже є акаунт?</span>
                        <a href="/virtualgallery/users/login" class="text-decoration-none ms-1 fw-bold" style="color: #D35400;">Увійти</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>