<?php /** @var array $artist */ ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-5">
                <h3 class="mb-4 text-center fw-bold">Редагування: <?= htmlspecialchars($artist['name']) ?></h3>
                <form action="/virtualgallery/artists/update" method="POST">
                    <input type="hidden" name="artist_id" value="<?= $artist['id'] ?>">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Ім'я та Прізвище <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($artist['name']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Роки життя</label>
                            <input type="text" name="years_of_life" class="form-control" value="<?= htmlspecialchars($artist['years_of_life']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Країна походження</label>
                            <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($artist['country']) ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">URL Портрета</label>
                            <input type="url" name="image" class="form-control" value="<?= htmlspecialchars($artist['image']) ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Біографія</label>
                            <textarea name="biography" class="form-control" rows="6"><?= htmlspecialchars($artist['biography']) ?></textarea>
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <a href="/virtualgallery/artists/view?id=<?= $artist['id'] ?>" class="btn btn-light px-4 me-2 border">Скасувати</a>
                            <button type="submit" class="btn btn-primary px-5">Зберегти зміни</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>