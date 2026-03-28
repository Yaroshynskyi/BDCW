<?php
/** @var array $user */
/** @var string $error_message */
?>
<div class="row justify-content-center mt-4 mb-5">
    <div class="col-md-6">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-5">
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
                    <h3 class="fw-bold text-dark m-0"><i class="bi bi-gear-fill text-secondary me-2"></i>Налаштування</h3>
                    <a href="/virtualgallery/users/profile" class="btn btn-outline-secondary btn-sm rounded-pill">Назад до профілю</a>
                </div>

                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger rounded-3 border-0 shadow-sm" role="alert">
                        <?= htmlspecialchars($error_message) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/virtualgallery/users/updateprofile">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label fw-bold small text-muted text-uppercase">Ім'я</label>
                            <input type="text" class="form-control bg-light border-0" id="firstName" name="firstname" value="<?= htmlspecialchars($user['firstName'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label fw-bold small text-muted text-uppercase">Прізвище</label>
                            <input type="text" class="form-control bg-light border-0" id="lastName" name="lastname" value="<?= htmlspecialchars($user['lastName'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold mb-3 text-dark">Зміна пароля (необов'язково)</h6>
                        <div class="mb-3">
                            <label for="password" class="form-label small text-muted">Новий пароль</label>
                            <input type="password" class="form-control bg-light border-0" id="password" name="password" placeholder="Залиште пустим, якщо не змінюєте">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label small text-muted">Підтвердження нового пароля</label>
                            <input type="password" class="form-control bg-light border-0" id="password_confirm" name="password2">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn w-100 text-white rounded-pill mt-3 shadow-sm" style="background-color: #2C3E50;">
                        Зберегти зміни
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>