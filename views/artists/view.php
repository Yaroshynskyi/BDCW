<?php
/** @var array $artist */
/** @var array $paintings */
/** @var array $favorite_ids */
use models\Users;
?>

<div class="mb-4">
    <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-pill btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Повернутися назад
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
    <div class="row g-0">
        <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-4" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
            <img src="<?= htmlspecialchars($artist['image'] ?? 'https://cdn-icons-png.flaticon.com/512/3237/3237472.png') ?>" 
                 class="img-fluid rounded-circle shadow-lg" 
                 alt="<?= htmlspecialchars($artist['name']) ?>" 
                 style="width: 250px; height: 250px; object-fit: cover; border: 6px solid white;">
        </div>
        <div class="col-md-8 p-5">
            <h1 class="display-5 fw-bold text-dark mb-3"><?= htmlspecialchars($artist['name']) ?></h1>

            <?php if (Users::isUserAdmin()): ?>
                <div class="mb-4">
                    <a href="/virtualgallery/artists/update?id=<?= $artist['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill me-2">
                        <i class="bi bi-pencil me-1"></i>Редагувати
                    </a>
                    <form action="/virtualgallery/artists/delete" method="POST" class="d-inline" onsubmit="return confirm('Видалити профіль цього митця назавжди? Всі його картини також будуть видалені!');">
                        <input type="hidden" name="artist_id" value="<?= $artist['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                            <i class="bi bi-trash me-1"></i>Видалити
                        </button>
                    </form>
                </div>
            <?php endif; ?>
            
            <div class="d-flex flex-wrap gap-4 mb-4">
                <span class="fs-5 text-muted">
                    <i class="bi bi-calendar3 text-danger me-2"></i><?= htmlspecialchars($artist['years_of_life']) ?>
                </span>
                <span class="fs-5 text-muted">
                    <i class="bi bi-geo-alt-fill text-danger me-2"></i><?= htmlspecialchars($artist['country']) ?>
                </span>
            </div>
            
            <h5 class="fw-bold mb-3 border-bottom pb-2">Біографія</h5>
            <p class="text-muted" style="line-height: 1.8; font-size: 1.1rem;">
                <?= nl2br(htmlspecialchars($artist['biography'])) ?>
            </p>
        </div>
    </div>
</div>

<h3 class="mb-4 fw-bold text-dark border-bottom pb-2">
    <i class="bi bi-palette-fill text-warning me-2"></i>Експонати в нашій галереї
</h3>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php if (empty($paintings)): ?>
        <div class="col-12">
            <div class="alert alert-light text-center py-4 text-muted">
                На жаль, картин цього автора ще немає в експозиції.
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($paintings as $painting): ?>
            <?php $in_collection = in_array($painting['id'], $favorite_ids ?? []); ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden painting-card">
                    <div class="img-container position-relative bg-dark" style="height: 220px; overflow: hidden;">
                        <img src="<?= htmlspecialchars($painting['image']) ?>" class="card-img-top painting-img" alt="<?= htmlspecialchars($painting['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-3 shadow">
                            <?= htmlspecialchars($painting['style_name']) ?>
                        </span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark mb-1"><?= htmlspecialchars($painting['title']) ?></h5>
                        <p class="text-muted small mb-3"><?= htmlspecialchars($painting['year_created']) ?> | <?= htmlspecialchars($painting['technique']) ?></p>
                        
                        <div class="mt-auto d-flex gap-2">
                            <a href="/virtualgallery/paintings/view?id=<?= $painting['id'] ?>" class="btn btn-outline-dark btn-sm flex-grow-1 rounded-pill">
                                Детальніше
                            </a>
                            
                            <?php if ($in_collection): ?>
                                <button type="button" class="btn btn-secondary btn-sm rounded-circle" title="Вже в колекції" disabled>
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            <?php else: ?>
                                <form action="/virtualgallery/favorites/add" method="POST" class="m-0">
                                    <input type="hidden" name="painting_id" value="<?= $painting['id'] ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" title="Додати в колекцію">
                                        <i class="bi bi-bookmark-plus-fill"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<style>
    .painting-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .painting-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
    .painting-img { transition: transform 0.5s ease; }
    .painting-card:hover .painting-img { transform: scale(1.05); }
</style>