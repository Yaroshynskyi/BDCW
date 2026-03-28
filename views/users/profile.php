<?php
/** @var array $user */
/** @var array $favorites */
?>
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
            <div class="mb-3">
                <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="Аватар" class="rounded-circle shadow-sm" style="width: 120px; height: 120px; border: 3px solid #D35400;">
            </div>
            <h4 class="fw-bold text-dark mb-1">
                <?= htmlspecialchars($user['firstName'] ?? '') ?> <?= htmlspecialchars($user['lastName'] ?? '') ?>
            </h4>
            <p class="text-muted mb-3">@<?= htmlspecialchars($user['login']) ?></p>
            
            <div class="d-flex justify-content-center gap-2 mt-2 border-top pt-4">
                <a href="/virtualgallery/users/updateprofile" class="btn btn-outline-secondary rounded-pill btn-sm px-3">
                    <i class="bi bi-gear me-1"></i>Налаштування
                </a>
                <a href="/virtualgallery/users/logout" class="btn btn-outline-danger rounded-pill btn-sm px-3">
                    <i class="bi bi-box-arrow-right me-1"></i>Вийти
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <h4 class="fw-bold text-secondary m-0"><i class="bi bi-bookmark-heart text-danger me-2"></i>Огляд колекції</h4>
                <a href="/virtualgallery/favorites/index" class="btn btn-sm btn-dark rounded-pill">Всі картини</a>
            </div>

            <?php if (empty($favorites)): ?>
                <div class="text-center py-4">
                    <i class="bi bi-image text-muted opacity-50" style="font-size: 3rem;"></i>
                    <p class="mt-2 text-muted">Ви ще не додали жодної картини до своєї колекції.</p>
                    <a href="/virtualgallery/paintings/index" class="btn btn-sm text-white rounded-pill mt-2" style="background-color: #D35400;">Перейти до галереї</a>
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    <?php 
                    // Виводимо лише останні 3 картини для прев'ю в профілі
                    $preview = array_slice($favorites, 0, 3);
                    foreach ($preview as $item): 
                    ?>
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                                <img src="<?= htmlspecialchars($item['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>" style="height: 120px; object-fit: cover;">
                                <div class="card-body p-2 text-center">
                                    <h6 class="card-title text-truncate mb-0 small fw-bold" title="<?= htmlspecialchars($item['title']) ?>">
                                        <?= htmlspecialchars($item['title']) ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if (count($favorites) > 3): ?>
                    <div class="text-center mt-3">
                        <span class="text-muted small">та ще <?= count($favorites) - 3 ?> експонатів...</span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>