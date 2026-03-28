<?php
namespace controllers;

use core\Controller;
use models\Favorites;
use models\Users;
use core\Core;

class FavoritesController extends Controller
{
    public function actionIndex()
    {
        if (!Users::IsUserLogged()) {
            return $this->redirect('/virtualgallery/users/login');
        }

        $user = Core::get()->session->get('user');
        $favorites = Favorites::getFavoritesByUserId($user['id']);

        $this->template->setParam('favorites', $favorites);
        
        $result = $this->render();
        $result['Title'] = 'Моя колекція картин';
        return $result;
    }

    public function actionAdd()
    {
        if (!Users::IsUserLogged()) {
            Core::get()->session->set('flash_error', 'Будь ласка, увійдіть в акаунт, щоб зберігати картини.');
            return $this->redirect('/virtualgallery/users/login');
        }

        if ($this->isPost) {
            $painting_id = $this->post->get('painting_id');
            $user = Core::get()->session->get('user');
            
            if (Favorites::addFavorite($user['id'], $painting_id)) {
                Core::get()->session->set('flash_success', 'Картину додано до вашої колекції!');
            } else {
                Core::get()->session->set('flash_error', 'Ця картина вже є у вашій колекції.');
            }
        }
        
        // Повертаємо користувача на ту ж сторінку, звідки він прийшов (щоб не кидало в корінь)
        $referer = $_SERVER['HTTP_REFERER'] ?? '/virtualgallery/paintings/index';
        return $this->redirect($referer);
    }

    public function actionRemove()
    {
        if ($this->isPost && Users::IsUserLogged()) {
            $painting_id = $this->post->get('painting_id');
            $user = Core::get()->session->get('user');
            
            Favorites::removeFavorite($user['id'], $painting_id);
            Core::get()->session->set('flash_success', 'Картину видалено з колекції.');
        }
        return $this->redirect('/virtualgallery/favorites/index');
    }
}