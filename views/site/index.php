<div class="main-container mt-5">
    <section class="intro-section text-center p-5">
        <h1 class="display-4">Вітаємо у <span class="art-highlight">Віртуальній Галереї</span>!</h1>
        <p class="lead">Відкрийте для себе найвідоміші шедеври світового живопису. Вивчайте стилі, дізнавайтесь про художників та створюйте власну колекцію улюблених картин.</p>
        <a class="btn btn-art btn-lg" href="/virtualgallery/paintings/index" role="button">
            <i class="bi bi-images me-2"></i>Перейти до експозиції
        </a>
    </section>

    <div class="row product-row">
        <div class="col-md-4">
            <div class="product-block">
                <div class="art-icon">🏛️</div>
                <h5 class="block-title">Відродження</h5>
                <p>Епоха титанів думки та пензля. Ідеальні пропорції, гармонія та велич людського духу.</p>
                <a href="/virtualgallery/paintings/index?style_id=1" class="btn btn-art">
                    <i class="bi bi-search me-2"></i>Шукати картини
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="product-block">
                <div class="art-icon">🌅</div>
                <h5 class="block-title">Імпресіонізм</h5>
                <p>Мистецтво вражень. Гра світла, яскраві кольори та миттєві емоції, зафіксовані на полотні.</p>
                <a href="/virtualgallery/paintings/index?style_id=2" class="btn btn-art">
                    <i class="bi bi-brush me-2"></i>Переглянути
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="product-block">
                <div class="art-icon">🌀</div>
                <h5 class="block-title">Сюрреалізм</h5>
                <p>Занурення у світ сновидінь та підсвідомості. Парадоксальні поєднання та магія образів.</p>
                <a href="/virtualgallery/paintings/index?style_id=5" class="btn btn-art">
                    <i class="bi bi-eye me-2"></i>Дослідити
                </a>
            </div>
        </div>
    </div>

    <div class="info-block mt-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="block-title"><i class="bi bi-bank me-2"></i>Мистецтво завжди поруч</h5>
                <p>Більше не потрібно купувати квитки та стояти в чергах до Лувру чи Прадо. Наша віртуальна галерея надає безкоштовний доступ до цифрових копій високої роздільної здатності. Зберігайте улюблені полотна у власний кабінет!</p>
                <a href="/virtualgallery/favorites/index" class="btn btn-art">
                    <i class="bi bi-bookmark-heart me-2"></i>Моя колекція
                </a>
            </div>
            <div class="col-md-4 text-center">
                <div class="gallery-icon">🖼️</div>
            </div>
        </div>
    </div>

    <div class="art-benefits mt-5 mb-5">
        <h3 class="text-center mb-4"><i class="bi bi-star-fill text-warning me-2"></i>Чому варто відвідати?</h3>
        <div class="row">
            <div class="col-md-3 text-center">
                <div class="benefit-icon">🌍</div>
                <h6>Світові шедеври</h6>
                <small>Найвідоміші картини світу</small>
            </div>
            <div class="col-md-3 text-center">
                <div class="benefit-icon">📖</div>
                <h6>Біографії митців</h6>
                <small>Історія створення та життя авторів</small>
            </div>
            <div class="col-md-3 text-center">
                <div class="benefit-icon">🔍</div>
                <h6>Зручний пошук</h6>
                <small>Фільтрація за стилем та автором</small>
            </div>
            <div class="col-md-3 text-center">
                <div class="benefit-icon">❤️</div>
                <h6>Власна виставка</h6>
                <small>Зберігайте улюблене в один клік</small>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --art-primary: #2C3E50; 
        --art-accent: #D35400;  
        --art-accent-hover: #A04000;
        --art-light: #ECF0F1;
        --art-dark: #2C3E50;
        --art-bg: #F8F9FA;
    }

    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .intro-section {
        background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
        color: white;
        border-radius: 25px;
        margin-bottom: 4rem;
        box-shadow: 0 10px 30px rgba(44, 62, 80, 0.2);
        position: relative;
        overflow: hidden;
    }

    .intro-section::before {
        content: '🎨';
        position: absolute;
        top: -20px;
        left: 20px;
        font-size: 8rem;
        opacity: 0.1;
        transform: rotate(-15deg);
    }

    .intro-section::after {
        content: '🏛️';
        position: absolute;
        bottom: -20px;
        right: 20px;
        font-size: 8rem;
        opacity: 0.1;
        transform: rotate(15deg);
    }

    .intro-section h1 {
        color: white;
        font-weight: 800;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .art-highlight {
        background: linear-gradient(45deg, #F39C12, #D35400);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 900;
        text-shadow: 0 0 15px rgba(211, 84, 0, 0.3);
    }

    .intro-section .lead {
        color: var(--art-light);
        font-size: 1.4rem;
        margin-bottom: 2.5rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        z-index: 2;
    }

    .product-row {
        display: flex;
        justify-content: space-around;
        margin-bottom: 4rem;
        gap: 2rem;
    }

    .product-block {
        background: white;
        padding: 2.5rem 2rem;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        text-align: center;
        width: 100%;
        transition: all 0.4s ease;
        border: 1px solid rgba(44, 62, 80, 0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-block:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(44, 62, 80, 0.15);
        border-color: var(--art-accent);
    }

    .art-icon {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .product-block:hover .art-icon {
        transform: scale(1.2) rotate(5deg);
    }

    .block-title {
        color: var(--art-primary);
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
        position: relative;
        padding-bottom: 10px;
    }

    .block-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--art-accent);
        border-radius: 2px;
    }

    .product-block p {
        color: #7f8c8d;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        flex-grow: 1;
    }

    .info-block {
        background: white;
        padding: 3rem;
        border-radius: 25px;
        margin-bottom: 4rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(44, 62, 80, 0.1);
        transition: all 0.4s ease;
    }

    .info-block:hover {
        box-shadow: 0 12px 30px rgba(44, 62, 80, 0.1);
    }

    .gallery-icon {
        font-size: 6rem;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    .btn-art {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 32px;
        background: var(--art-accent);
        color: #ffffff;
        text-decoration: none;
        border-radius: 30px;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-art:hover {
        background: var(--art-accent-hover);
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(211, 84, 0, 0.3);
    }

    .art-benefits {
        background: white;
        padding: 3rem;
        border-radius: 25px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(44, 62, 80, 0.1);
    }

    .art-benefits h3 {
        color: var(--art-primary);
        font-weight: 700;
        margin-bottom: 3rem;
    }

    .art-benefits h6 {
        color: var(--art-dark);
        font-weight: 700;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }

    .art-benefits small {
        color: #7f8c8d;
        font-size: 0.95rem;
    }

    .benefit-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .benefit-icon:hover {
        transform: scale(1.2);
    }

    @media (max-width: 768px) {
        .product-row {
            flex-direction: column;
        }
    }
</style>