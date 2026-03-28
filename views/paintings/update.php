<?php
/** @var array $painting */
/** @var array $styles */
/** @var array $artists */
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-5">
                <h3 class="mb-4 text-center fw-bold">Редагування: <?= htmlspecialchars($painting['title']) ?></h3>
                
                <form action="/virtualgallery/paintings/update" method="POST">
                    <input type="hidden" name="painting_id" value="<?= $painting['id'] ?>">
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Назва картини <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($painting['title']) ?>">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Художник <span class="text-danger">*</span></label>
                            <select name="artist_id" class="form-select" required>
                                <?php foreach ($artists as $artist): ?>
                                    <option value="<?= $artist['id'] ?>" <?= ($painting['artist_id'] == $artist['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($artist['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Стиль/Напрямок <span class="text-danger">*</span></label>
                            <select name="style_id" class="form-select" required>
                                <?php foreach ($styles as $style): ?>
                                    <option value="<?= $style['id'] ?>" <?= ($painting['style_id'] == $style['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($style['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Рік створення</label>
                            <input type="text" name="year_created" class="form-control" value="<?= htmlspecialchars($painting['year_created']) ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Техніка</label>
                            <input type="text" name="technique" class="form-control" value="<?= htmlspecialchars($painting['technique']) ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Розміри</label>
                            <input type="text" name="dimensions" class="form-control" value="<?= htmlspecialchars($painting['dimensions']) ?>">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">URL Зображення</label>
                            <input type="url" name="image" class="form-control" value="<?= htmlspecialchars($painting['image']) ?>">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">Опис картини та історія</label>
                            <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($painting['description']) ?></textarea>
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <a href="/virtualgallery/paintings/view?id=<?= $painting['id'] ?>" class="btn btn-light px-4 me-2 border">Скасувати</a>
                            <button type="submit" class="btn btn-primary px-5">Зберегти зміни</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>