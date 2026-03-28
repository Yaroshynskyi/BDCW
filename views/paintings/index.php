<?php
/** @var array $paintings */
/** @var array $styles */
/** @var array $artists */
/** @var array $techniques */
/** @var array $current_filters */
use models\Users;
?>

<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="mb-0 text-secondary"><i class="bi bi-palette me-2"></i>Експозиція галереї</h2>
    </div>
    <?php if (Users::isUserAdmin()): ?>
        <div class="col-md-4 text-end">
            <a href="/virtualgallery/paintings/add" class="btn btn-success rounded-pill px-4">
                <i class="bi bi-plus-lg me-1"></i>Додати експонат
            </a>
        </div>
    <?php endif; ?>
</div>

<div class="card shadow-sm border-0 rounded-4 mb-5 bg-light">
    <div class="card-body p-4">
        <form action="/virtualgallery/paintings/index" method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-bold text-muted small text-uppercase">Стиль</label>
                <select name="style_id" class="form-select border-0 shadow-sm rounded-3">
                    <option value="">Всі стилі</option>
                    <?php foreach ($styles as $style): ?>
                        <option value="<?= $style['id'] ?>" <?= ($current_filters['style_id'] == $style['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($style['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-3">
                <label class="form-label fw-bold text-muted small text-uppercase">Художник</label>
                <select name="artist_id" class="form-select border-0 shadow-sm rounded-3">
                    <option value="">Всі митці</option>
                    <?php foreach ($artists as $artist): ?>
                        <option value="<?= $artist['id'] ?>" <?= ($current_filters['artist_id'] == $artist['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($artist['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold text-muted small text-uppercase">Техніка</label>
                <select name="technique" class="form-select border-0 shadow-sm rounded-3">
                    <option value="">Всі техніки</option>
                    <?php foreach ($techniques as $tech): ?>
                        <option value="<?= htmlspecialchars($tech) ?>" <?= ($current_filters['technique'] == $tech) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tech) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-dark w-100 rounded-3 shadow-sm" style="background-color: #2C3E50;">
                    <i class="bi bi-funnel-fill me-2"></i>Застосувати
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php if (empty($paintings)): ?>
        <div class="col-12 text-center py-5">
            <h3 class="text-muted"><i class="bi bi-image text-light" style="font-size: 4rem;"></i><br>Експонатів не знайдено</h3>
            <p>Спробуйте змінити параметри пошуку.</p>
            <a href="/virtualgallery/paintings/index" class="btn btn-outline-secondary mt-2">Скинути фільтри</a>
        </div>
    <?php else: ?>
        <?php foreach ($paintings as $painting): ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden painting-card">
                    <div class="img-container position-relative bg-dark">
                        <img src="<?= htmlspecialchars($painting['image']) ?>" class="card-img-top painting-img" alt="<?= htmlspecialchars($painting['title']) ?>" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2970/2970785.png'">
                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-3 shadow">
                            <?= htmlspecialchars($painting['style_name']) ?>
                        </span>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h4 class="card-title fw-bold text-dark mb-1"><?= htmlspecialchars($painting['title']) ?></h4>
                        <p class="text-muted mb-3"><i class="bi bi-person-fill me-1"></i><a href="/virtualgallery/artists/view?id=<?= $painting['artist_id'] ?>" class="text-decoration-none text-danger fw-semibold hover-underline"><?= htmlspecialchars($painting['artist_name']) ?></a></p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3 small text-secondary">
                            <span><i class="bi bi-calendar3 me-1"></i> <?= htmlspecialchars($painting['year_created']) ?></span>
                            <span><i class="bi bi-brush me-1"></i> <?= htmlspecialchars($painting['technique']) ?></span>
                        </div>
                        
                        <div class="mt-auto pt-3 border-top d-flex gap-2">
                            <a href="/virtualgallery/paintings/view?id=<?= $painting['id'] ?>" class="btn btn-outline-dark flex-grow-1 rounded-pill">
                                Детальніше
                            </a>
                            <?php $in_collection = in_array($painting['id'], $favorite_ids ?? []); ?>
                            <?php if ($in_collection): ?>
                                <button type="button" class="btn btn-secondary rounded-circle" title="Вже в колекції" disabled>
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            <?php else: ?>
                                <form action="/virtualgallery/favorites/add" method="POST" class="m-0">
                                    <input type="hidden" name="painting_id" value="<?= $painting['id'] ?>">
                                    <button type="submit" class="btn rounded-circle btn-add-fav" title="Додати в колекцію">
                                        <i class="bi bi-bookmark-plus-fill"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<style>
    .painting-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .painting-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    .img-container {
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .painting-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .painting-card:hover .painting-img {
        transform: scale(1.05);
    }
    .btn-add-fav {
        background-color: #F8F9FA;
        color: #D35400;
        border: 1px solid #D35400;
        transition: all 0.2s;
    }
    .btn-add-fav:hover {
        background-color: #D35400;
        color: white;
    }
</style>