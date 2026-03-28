<?php
/** @var array $painting */
/** @var array $favorite_ids */
use models\Users;

$in_collection = in_array($painting['id'], $favorite_ids ?? []);
?>

<div class="mb-4">
    <a href="/virtualgallery/paintings/index" class="btn btn-outline-secondary rounded-pill btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Повернутися до галереї
    </a>
</div>

<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
    <div class="row g-0">
        <div class="col-md-6 bg-dark d-flex align-items-center justify-content-center p-4 position-relative image-zoom-container" data-bs-toggle="modal" data-bs-target="#imageZoomModal" title="Натисніть, щоб збільшити">
            <img src="<?= htmlspecialchars($painting['image']) ?>" class="img-fluid rounded shadow painting-zoom-target" alt="<?= htmlspecialchars($painting['title']) ?>" style="max-height: 600px; object-fit: contain; cursor: zoom-in;">
            <div class="zoom-hint position-absolute bottom-0 end-0 m-4 text-white opacity-75">
                <i class="bi bi-arrows-angle-expand fs-4 shadow-sm"></i>
            </div>
        </div>
        
        <div class="col-md-6 p-5 d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">
                    <?= htmlspecialchars($painting['style_name']) ?>
                </span>
                <?php if (Users::isUserAdmin()): ?>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li><a class="dropdown-item" href="/virtualgallery/paintings/update?id=<?= $painting['id'] ?>"><i class="bi bi-pencil me-2 text-primary"></i>Редагувати</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/virtualgallery/paintings/delete" method="POST" onsubmit="return confirm('Видалити цей експонат назавжди?');">
                                    <input type="hidden" name="painting_id" value="<?= $painting['id'] ?>">
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Видалити</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <h1 class="display-5 fw-bold text-dark mt-2 mb-1"><?= htmlspecialchars($painting['title']) ?></h1>
            <h4 class="text-secondary mb-4"><i class="bi bi-person-fill text-muted me-2"></i><a href="/virtualgallery/artists/view?id=<?= $painting['artist_id'] ?>" class="text-decoration-none text-danger fw-semibold hover-underline"><?= htmlspecialchars($painting['artist_name']) ?></a></h4>

            <div class="bg-light rounded-3 p-4 mb-4">
                <div class="row g-3">
                    <div class="col-6">
                        <span class="d-block text-muted small text-uppercase fw-bold mb-1">Рік створення</span>
                        <span class="fs-6"><i class="bi bi-calendar-event me-2 text-secondary"></i><?= htmlspecialchars($painting['year_created']) ?></span>
                    </div>
                    <div class="col-6">
                        <span class="d-block text-muted small text-uppercase fw-bold mb-1">Техніка</span>
                        <span class="fs-6"><i class="bi bi-brush me-2 text-secondary"></i><?= htmlspecialchars($painting['technique']) ?></span>
                    </div>
                    <div class="col-12 mt-3 pt-3 border-top">
                        <span class="d-block text-muted small text-uppercase fw-bold mb-1">Фізичні розміри</span>
                        <span class="fs-6"><i class="bi bi-arrows-fullscreen me-2 text-secondary"></i><?= htmlspecialchars($painting['dimensions']) ?></span>
                    </div>
                </div>
            </div>

            <div class="flex-grow-1">
                <h5 class="fw-bold mb-3">Про експонат</h5>
                <p class="text-muted" style="line-height: 1.8;">
                    <?= nl2br(htmlspecialchars($painting['description'])) ?>
                </p>
            </div>

            <div class="mt-4 pt-4 border-top">
                <?php if ($in_collection): ?>
                    <button class="btn btn-lg w-100 shadow-sm text-white bg-secondary" disabled style="border-radius: 50px;">
                        <i class="bi bi-check-circle-fill me-2"></i> Вже у вашій колекції
                    </button>
                <?php else: ?>
                    <form action="/virtualgallery/favorites/add" method="POST">
                        <input type="hidden" name="painting_id" value="<?= $painting['id'] ?>">
                        <button type="submit" class="btn btn-lg w-100 shadow-sm text-white" style="background-color: #D35400; border-radius: 50px;">
                            <i class="bi bi-bookmark-heart-fill me-2"></i> Додати до власної колекції
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageZoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0 pb-0 justify-content-end position-absolute top-0 end-0 z-3 p-4">
                <button type="button" class="btn-close btn-close-white shadow-none fs-4" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 d-flex justify-content-center align-items-center overflow-hidden" id="zoomContainer" style="cursor: zoom-in;">
                <img src="<?= htmlspecialchars($painting['image']) ?>" id="zoomedImage" alt="<?= htmlspecialchars($painting['title']) ?>" style="max-height: 95vh; max-width: 95vw; object-fit: contain; transition: transform 0.15s ease-out; transform-origin: center center;">
            </div>
            <div class="position-absolute bottom-0 start-50 translate-middle-x p-3 text-white-50 small pointer-events-none">
                Натисніть на зображення, щоб наблизити, і рухайте мишкою.
            </div>
        </div>
    </div>
</div>

<style>
    .image-zoom-container:hover .painting-zoom-target {
        opacity: 0.9;
    }
    .zoom-hint {
        transition: transform 0.2s;
    }
    .image-zoom-container:hover .zoom-hint {
        transform: scale(1.1);
    }
</style>

<script>
    // Скрипт для роботи інтерактивної лупи
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('zoomContainer');
        const img = document.getElementById('zoomedImage');
        let isZoomed = false;

        container.addEventListener('click', function(e) {
            isZoomed = !isZoomed;
            if (isZoomed) {
                // Збільшуємо масштаб (2.5x) і змінюємо курсор
                img.style.transform = 'scale(2.5)';
                container.style.cursor = 'zoom-out';
                updateOrigin(e);
            } else {
                // Повертаємо до початкового стану
                img.style.transform = 'scale(1)';
                container.style.cursor = 'zoom-in';
            }
        });

        container.addEventListener('mousemove', function(e) {
            if (isZoomed) {
                updateOrigin(e);
            }
        });

        // Скидаємо зум при закритті модального вікна
        document.getElementById('imageZoomModal').addEventListener('hidden.bs.modal', function () {
            isZoomed = false;
            img.style.transform = 'scale(1)';
            container.style.cursor = 'zoom-in';
        });

        // Функція для розрахунку точки масштабування відносно курсора
        function updateOrigin(e) {
            const rect = container.getBoundingClientRect();
            // Знаходимо позицію миші у відсотках відносно контейнера
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            // Зміщуємо центр збільшення (transform-origin)
            img.style.transformOrigin = `${x}% ${y}%`;
        }
    });
</script>