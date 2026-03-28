<?php
/** @var array $styles */
/** @var array $artists */
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-5">
                <h3 class="mb-4 text-center fw-bold">Новий експонат</h3>
                
                <form action="/virtualgallery/paintings/add" method="POST">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Назва картини <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="Наприклад: Мона Ліза">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Художник <span class="text-danger">*</span></label>
                            <select name="artist_id" class="form-select" required>
                                <option value="" disabled selected>Оберіть митця...</option>
                                <?php foreach ($artists as $artist): ?>
                                    <option value="<?= $artist['id'] ?>"><?= htmlspecialchars($artist['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Стиль/Напрямок <span class="text-danger">*</span></label>
                            <select name="style_id" class="form-select" required>
                                <option value="" disabled selected>Оберіть стиль...</option>
                                <?php foreach ($styles as $style): ?>
                                    <option value="<?= $style['id'] ?>"><?= htmlspecialchars($style['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Рік створення</label>
                            <input type="text" name="year_created" class="form-control" placeholder="Напр. 1503 або XIX ст.">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Техніка</label>
                            <input type="text" name="technique" class="form-control" placeholder="Напр. Олія на полотні">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Розміри</label>
                            <input type="text" name="dimensions" class="form-control" placeholder="Напр. 77 × 53 см">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">URL Зображення</label>
                            <input type="url" name="image" class="form-control" placeholder="https://...">
                            <div class="form-text">Вставте пряме посилання на зображення картини.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">Опис картини та історія</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Розкажіть про створення картини, її особливості..."></textarea>
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <a href="/virtualgallery/paintings/index" class="btn btn-light px-4 me-2 border">Скасувати</a>
                            <button type="submit" class="btn btn-success px-5">Додати до галереї</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>