<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-5">
                <h3 class="mb-4 text-center fw-bold">Додати нового митця</h3>
                <form action="/virtualgallery/artists/add" method="POST">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Ім'я та Прізвище <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required placeholder="Наприклад: Сальвадор Далі">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Роки життя</label>
                            <input type="text" name="years_of_life" class="form-control" placeholder="Напр. 1904 - 1989">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Країна походження</label>
                            <input type="text" name="country" class="form-control" placeholder="Напр. Іспанія">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">URL Портрета</label>
                            <input type="url" name="image" class="form-control" placeholder="https://...">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Біографія</label>
                            <textarea name="biography" class="form-control" rows="6" placeholder="Життєвий та творчий шлях митця..."></textarea>
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <a href="/virtualgallery/artists/index" class="btn btn-light px-4 me-2 border">Скасувати</a>
                            <button type="submit" class="btn btn-success px-5">Додати митця</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>