<?php

/** @var string $Title */
/** @var string $Content */

use models\Users;

if (empty($Title)) {
    $Title = "";
}
if (empty($Content)) {
    $Content = "";
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Віртуальна Галерея - Шедеври мистецтва</title>
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2970/2970785.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --art-primary: #2C3E50;
            --art-accent: #D35400; /* Більш "художній" теракотовий колір */
            --art-accent-hover: #A04000;
            --art-light: #ECF0F1;
            --art-dark: #1a252f;
            --art-bg: #F8F9FA;
        }

        body {
            background: var(--art-bg);
            color: var(--art-primary);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        .navbar {
            background: linear-gradient(to right, var(--art-dark), var(--art-primary));
            padding: 1rem 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border-bottom: 3px solid var(--art-accent);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 800;
            font-size: 1.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .brand-highlight {
            color: var(--art-accent);
        }

        .nav-link {
            color: var(--art-light) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .dropdown-menu {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border: 2px solid var(--art-accent);
            transition: all 0.3s ease;
            background: white;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(211, 84, 0, 0.4);
        }

        .container-content {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(44, 62, 80, 0.1);
        }

        h1 {
            color: var(--art-primary);
            font-weight: 800;
            padding-bottom: 10px;
            border-bottom: 3px solid var(--art-accent);
            display: inline-block;
            margin-bottom: 2rem;
        }
        
        footer {
            background: var(--art-dark);
            color: var(--art-light);
            padding: 3rem 0;
            margin-top: auto;
            border-top: 4px solid var(--art-accent);
        }

        footer p {
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .footer-icon {
            color: var(--art-accent);
            margin: 0 10px;
            font-size: 1.2rem;
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <?php 
        $flashMessage = \core\Core::get()->session->get('flash_success');
        if (!empty($flashMessage)): 
            \core\Core::get()->session->remove('flash_success');
        ?>
            <div id="flash-msg" class="alert alert-success position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index: 1050; box-shadow: 0 4px 15px rgba(0,0,0,0.2); min-width: 300px; text-align: center;">
                <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($flashMessage) ?>
            </div>
            <script>
                setTimeout(function() {
                    let flashMsg = document.getElementById('flash-msg');
                    if (flashMsg) {
                        flashMsg.style.transition = 'opacity 0.5s ease';
                        flashMsg.style.opacity = '0';
                        setTimeout(() => flashMsg.remove(), 500);
                    }
                }, 3000);
            </script>
        <?php endif; ?>

        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="navbar-container container-fluid d-flex justify-content-between align-items-center">
                <a href="/virtualgallery/" class="navbar-brand">
                    <i class="bi bi-palette-fill me-2 text-warning"></i>Арт<span class="brand-highlight">Галерея</span>
                </a>
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex gap-3">
                    <li class="nav-item"><a href="/virtualgallery/" class="nav-link"><i class="bi bi-house-door me-1"></i>Головна</a></li>
                    <li class="nav-item"><a href="/virtualgallery/paintings/index" class="nav-link"><i class="bi bi-images me-1"></i>Галерея</a></li>
                    <li class="nav-item"><a href="/virtualgallery/artists/index" class="nav-link"><i class="bi bi-person-lines-fill me-1"></i>Митці</a></li>
                    <li class="nav-item"><a href="/virtualgallery/favorites/index" class="nav-link"><i class="bi bi-bookmark-heart me-1"></i>Моя колекція</a></li>
                </ul>
                
                <?php if (\models\Users::IsUserLogged()) : ?>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="Користувач" width="40" height="40" class="rounded-circle user-avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="/virtualgallery/users/profile"><i class="bi bi-person-circle me-2"></i>Профіль</a></li>
                            <?php if (\models\Users::isUserAdmin()) : ?>
                                 <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/virtualgallery/paintings/add"><i class="bi bi-plus-circle me-2"></i>Додати експонат</a></li>
                                <li><a class="dropdown-item" href="/virtualgallery/artists/add"><i class="bi bi-person-plus me-2"></i>Додати митця</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/virtualgallery/users/logout"><i class="bi bi-box-arrow-right me-2 text-danger"></i>Вийти</a></li>
                        </ul>
                    </div>
                <?php else : ?>
                    <div class="text-end">
                        <a href="/virtualgallery/users/login" class="btn btn-outline-light me-2 rounded-pill px-4">Увійти</a>
                        <a href="/virtualgallery/users/register" class="btn" style="background-color: var(--art-accent); color: white; border-radius: 50px;">Зареєструватися</a>
                    </div>
                <?php endif; ?>
            </div>
        </nav>

        <div class="container container-content">
            <?php if (!empty($Title) && !in_array($Title, ['Каталог віртуальної галереї', 'Вхід в систему', 'Реєстрація', 'Успішна реєстрація'])): ?>
                <div class="text-center">
                    <h1><?= $Title ?></h1>
                </div>
            <?php endif; ?>
            <?= $Content ?>
        </div>
    </div>

    <footer>
        <div class="container">
            <p class="text-center mb-4">
                <i class="bi bi-brush-fill footer-icon"></i>
                © 2026 Віртуальна Галерея - Доторкнись до прекрасного
                <i class="bi bi-image-fill footer-icon"></i>
            </p>
            <ul class="nav justify-content-center flex-wrap">
                <li class="nav-item"><a href="/virtualgallery/site/index" class="nav-link px-3 text-white opacity-75">Головна</a></li>
                <li class="nav-item"><a href="/virtualgallery/paintings/index" class="nav-link px-3 text-white opacity-75">Галерея</a></li>
                <li class="nav-item"><a href="/virtualgallery/information/contacts" class="nav-link px-3 text-white opacity-75">Контакти</a></li>
                <li class="nav-item"><a href="/virtualgallery/information/about" class="nav-link px-3 text-white opacity-75">Про проект</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>