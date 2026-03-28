<?php
/** @var array $favorites */
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h2 class="mb-0 text-secondary"><i class="bi bi-bookmark-heart text-danger me-2"></i>Моя приватна колекція</h2>
    <span class="badge bg-secondary rounded-pill fs-6"><?= count($favorites) ?> експонатів</span>
</div>

<?php if (empty($favorites)): ?>
    <div class="text-center py-5 bg-light rounded-4 border-dashed">
        <i class="bi bi-images text-muted" style="font-size: 5rem;"></i>
        <h3 class="mt-3 text-dark">Ваша колекція порожня</h3>
        <p class="text-muted">Час відвідати галерею та знайти шедеври до душі.</p>
        <a href="/virtualgallery/paintings/index" class="btn btn-lg text-white mt-3 rounded-pill" style="background-color: #D35400;">
            <i class="bi bi-compass me-2"></i>Дослідити галерею
        </a>
    </div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php foreach ($favorites as $item): ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                    <img src="<?= htmlspecialchars($item['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body p-3 d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark mb-1 text-truncate" title="<?= htmlspecialchars($item['title']) ?>">
                            <?= htmlspecialchars($item['title']) ?>
                        </h5>
                        <p class="text-muted small mb-3 text-truncate"><i class="bi bi-person me-1"></i><?= htmlspecialchars($item['artist_name']) ?></p>
                        
                        <div class="mt-auto d-flex gap-2">
                            <a href="/virtualgallery/paintings/view?id=<?= $item['painting_id'] ?>" class="btn btn-outline-dark btn-sm flex-grow-1 rounded-pill">
                                Оглянути
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteFavModal" data-painting-id="<?= $item['painting_id'] ?>" data-painting-title="<?= htmlspecialchars($item['title']) ?>" title="Видалити з колекції">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="modal fade" id="deleteFavModal" tabindex="-1" aria-labelledby="deleteFavModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger" id="deleteFavModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Підтвердження
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5 text-center mt-3 mb-2">
                Ви дійсно хочете видалити експонат <br><strong id="modalPaintingTitle" class="text-dark"></strong><br> з вашої колекції?
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Скасувати</button>
                <form action="/virtualgallery/favorites/remove" method="POST" class="m-0">
                    <input type="hidden" name="painting_id" id="modalPaintingId" value="">
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Так, видалити</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Скрипт для передачі даних у модальне вікно
    document.addEventListener('DOMContentLoaded', function () {
        const deleteFavModal = document.getElementById('deleteFavModal');
        if (deleteFavModal) {
            deleteFavModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const paintingId = button.getAttribute('data-painting-id');
                const paintingTitle = button.getAttribute('data-painting-title');

                document.getElementById('modalPaintingId').value = paintingId;
                document.getElementById('modalPaintingTitle').textContent = '«' + paintingTitle + '»';
            });
        }
    });
</script>