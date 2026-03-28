<?php
namespace controllers;

use core\Controller;
use models\Paintings;
use models\Styles;
use models\Artists;

class PaintingsController extends Controller
{
    public function actionIndex()
    {
        // Збираємо фільтри з GET-запиту
        $filters = [
            'style_id' => $this->get->get('style_id'),
            'artist_id' => $this->get->get('artist_id'),
            'technique' => $this->get->get('technique')
        ];

        // Отримуємо відфільтровані картини
        $paintings = Paintings::filterPaintings($filters);

        // Дані для випадаючих списків у фільтрі
        $styles = Styles::getAllStyles();
        $artists = Artists::getAllArtists();
        $techniques = Paintings::getUniqueValues('technique');

        $this->template->setParam('paintings', $paintings);
        $this->template->setParam('styles', $styles);
        $this->template->setParam('artists', $artists);
        $this->template->setParam('techniques', $techniques);
        $this->template->setParam('current_filters', $filters); 

        $favorite_ids = [];
        if (\models\Users::IsUserLogged()) {
            $user = \core\Core::get()->session->get('user');
            $favs = \models\Favorites::getFavoritesByUserId($user['id']);
            // Витягуємо тільки ID картин у простий масив
            $favorite_ids = array_column($favs, 'painting_id');
        }
        $this->template->setParam('favorite_ids', $favorite_ids);
        
        $result = $this->render();
        $result['Title'] = 'Каталог віртуальної галереї';
        return $result;
    }

    public function actionView()
    {
        $id = $this->get->get('id');
        
        if (empty($id)) {
            return $this->redirect('/virtualgallery/paintings/index');
        }

        $painting = Paintings::getPaintingById($id);
        
        if (empty($painting)) {
            \core\Core::get()->session->set('flash_error', 'Картину не знайдено!');
            return $this->redirect('/virtualgallery/paintings/index');
        }

        $this->template->setParam('painting', $painting);

        $favorite_ids = [];
        if (\models\Users::IsUserLogged()) {
            $user = \core\Core::get()->session->get('user');
            $favs = \models\Favorites::getFavoritesByUserId($user['id']);
            // Витягуємо тільки ID картин у простий масив
            $favorite_ids = array_column($favs, 'painting_id');
        }
        $this->template->setParam('favorite_ids', $favorite_ids);
        
        $result = $this->render();
        $result['Title'] = $painting['title'];
        return $result;
    }

    public function actionAdd()
    {
        if (!\models\Users::isUserAdmin()) return $this->redirect('/virtualgallery/');

        if ($this->isPost) {
            $title = $this->post->get('title');
            $description = $this->post->get('description');
            $year_created = $this->post->get('year_created');
            $technique = $this->post->get('technique');
            $dimensions = $this->post->get('dimensions');
            $image = $this->post->get('image');
            $style_id = $this->post->get('style_id');
            $artist_id = $this->post->get('artist_id');

            if (empty($title)) $this->addErrorMessage('Назва не вказана');
            if (empty($style_id)) $this->addErrorMessage('Стиль не обрано');
            if (empty($artist_id)) $this->addErrorMessage('Художника не обрано');

            if (!$this->isErrorMessageExists()) {
                Paintings::addPainting($title, $description, $year_created, $technique, $dimensions, $image, $style_id, $artist_id);
                \core\Core::get()->session->set('flash_success', 'Картину успішно додано до галереї!');
                return $this->redirect("/virtualgallery/paintings/index"); 
            }
        }
        
        $this->template->setParam('styles', Styles::getAllStyles());
        $this->template->setParam('artists', Artists::getAllArtists());
        
        $result = $this->render();
        $result['Title'] = 'Додавання нової картини';
        return $result;
    }

    public function actionUpdate()
    {
       if (!\models\Users::isUserAdmin()) return $this->redirect('/virtualgallery/');

        // Отримуємо ID: з POST при збереженні форми, або з GET при першому відкритті сторінки
        $painting_id = $this->isPost ? $this->post->get('painting_id') : $this->get->get('id');

        if (empty($painting_id)) return $this->redirect('/virtualgallery/paintings/index');

        $painting = Paintings::getPaintingById($painting_id);
        if (empty($painting)) return $this->redirect('/virtualgallery/paintings/index');

         if ($this->isPost && !empty($this->post->get('title'))) {
            $newData = [
                'title' => $this->post->get('title'),
                'description' => $this->post->get('description'),
                'year_created' => $this->post->get('year_created'),
                'technique' => $this->post->get('technique'),
                'dimensions' => $this->post->get('dimensions'),
                'image' => $this->post->get('image'),
                'style_id' => $this->post->get('style_id'),
                'artist_id' => $this->post->get('artist_id')
            ];
            
            $paintingModel = new Paintings();
            $paintingModel->updatePaintingById($painting_id, $newData);
            
            \core\Core::get()->session->set('flash_success', 'Зміни успішно збережено!');
            return $this->redirect('/virtualgallery/paintings/index');
        }

        $this->template->setParam('painting', $painting);
        $this->template->setParam('styles', Styles::getAllStyles());
        $this->template->setParam('artists', Artists::getAllArtists());
        
        $result = $this->render();
        $result['Title'] = 'Редагування картини';
        return $result;
    }

    public function actionDelete()
    {
        if (!\models\Users::isUserAdmin()) return $this->redirect('/virtualgallery/');

        if ($this->isPost) {
            $painting_id = $this->post->get('painting_id');
            if (!empty($painting_id)) {
                $paintingModel = new Paintings();
                $paintingModel->deletePaintingById($painting_id);
                \core\Core::get()->session->set('flash_success', 'Експонат успішно видалено з галереї.');
            }
        }
        return $this->redirect('/virtualgallery/paintings/index');
    }
}