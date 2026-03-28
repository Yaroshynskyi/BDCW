<?php
/** @var array $artists */
use models\Users;
?>
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="mb-0 text-secondary"><i class="bi bi-people-fill me-2"></i>Каталог митців</h2>
    </div>
    <?php if (Users::isUserAdmin()): ?>
        <div class="col-md-4 text-end">
            <a href="/virtualgallery/artists/add" class="btn btn-success rounded-pill px-4">
                <i class="bi bi-plus-lg me-1"></i>Додати митця
            </a>
        </div>
    <?php endif; ?>
</div>

<div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
    <?php foreach ($artists as $artist): ?>
        <div class="col">
            <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-3 artist-card">
                <div class="mx-auto mt-3 mb-2">
                    <img src="<?= htmlspecialchars($artist['image'] ?? 'https://cdn-icons-png.flaticon.com/512/3237/3237472.png') ?>" 
                         class="rounded-circle object-fit-cover shadow-sm" 
                         alt="<?= htmlspecialchars($artist['name']) ?>" 
                         style="width: 150px; height: 150px; border: 4px solid #ECF0F1;">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($artist['name']) ?></h5>
                    <p class="text-muted small mb-3"><?= htmlspecialchars($artist['years_of_life']) ?></p>
                    <a href="/virtualgallery/artists/view?id=<?= $artist['id'] ?>" class="btn btn-outline-dark mt-auto rounded-pill btn-sm w-100">
                        Відкрити профіль
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<style>
    .artist-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .artist-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; border-bottom: 3px solid #D35400 !important; }
</style>