<?php
namespace controllers;

use core\Controller;
use models\Artists;
use models\Paintings;
use models\Users;
use core\Core;

class ArtistsController extends Controller
{
    public function actionIndex()
    {
        $artists = Artists::getAllArtists();
        $this->template->setParam('artists', $artists);
        
        $result = $this->render();
        $result['Title'] = 'Видатні митці';
        return $result;
    }

    public function actionView()
    {
        $id = $this->get->get('id');
        if (empty($id)) return $this->redirect('/virtualgallery/artists/index');

        $artist = Artists::getArtistById($id);
        if (empty($artist)) {
            Core::get()->session->set('flash_error', 'Художника не знайдено!');
            return $this->redirect('/virtualgallery/artists/index');
        }

        $paintings = Paintings::filterPaintings(['artist_id' => $id]);
        $favorite_ids = [];
        if (Users::IsUserLogged()) {
            $user = Core::get()->session->get('user');
            $favs = \models\Favorites::getFavoritesByUserId($user['id']);
            $favorite_ids = array_column($favs, 'painting_id');
        }

        $this->template->setParam('artist', $artist);
        $this->template->setParam('paintings', $paintings);
        $this->template->setParam('favorite_ids', $favorite_ids);
        
        $result = $this->render();
        $result['Title'] = 'Профіль митця: ' . $artist['name'];
        return $result;
    }

    public function actionAdd()
    {
        if (!Users::isUserAdmin()) return $this->redirect('/virtualgallery/');

        if ($this->isPost) {
            $name = $this->post->get('name');
            $years_of_life = $this->post->get('years_of_life');
            $country = $this->post->get('country');
            $biography = $this->post->get('biography');
            $image = $this->post->get('image');

            if (empty($name)) $this->addErrorMessage('Ім\'я митця не вказано');

            if (!$this->isErrorMessageExists()) {
                Artists::addArtist($name, $years_of_life, $country, $biography, $image);
                Core::get()->session->set('flash_success', 'Митця успішно додано!');
                return $this->redirect("/virtualgallery/artists/index"); 
            }
        }
        
        $result = $this->render();
        $result['Title'] = 'Додавання митця';
        return $result;
    }

    public function actionUpdate()
    {
        if (!Users::isUserAdmin()) return $this->redirect('/virtualgallery/');

        $artist_id = $this->isPost ? $this->post->get('artist_id') : $this->get->get('id');
        if (empty($artist_id)) return $this->redirect('/virtualgallery/artists/index');

        $artist = Artists::getArtistById($artist_id);
        if (empty($artist)) return $this->redirect('/virtualgallery/artists/index');

        if ($this->isPost && !empty($this->post->get('name'))) {
            $newData = [
                'name' => $this->post->get('name'),
                'years_of_life' => $this->post->get('years_of_life'),
                'country' => $this->post->get('country'),
                'biography' => $this->post->get('biography'),
                'image' => $this->post->get('image')
            ];
            
            $artistModel = new Artists();
            $artistModel->updateArtistById($artist_id, $newData);
            
            Core::get()->session->set('flash_success', 'Профіль митця оновлено!');
            return $this->redirect('/virtualgallery/artists/view?id=' . $artist_id);
        }

        $this->template->setParam('artist', $artist);
        
        $result = $this->render();
        $result['Title'] = 'Редагування профілю митця';
        return $result;
    }

    public function actionDelete()
    {
        if (!Users::isUserAdmin()) return $this->redirect('/virtualgallery/');

        if ($this->isPost) {
            $artist_id = $this->post->get('artist_id');
            if (!empty($artist_id)) {
                $artistModel = new Artists();
                $artistModel->deleteArtistById($artist_id);
                Core::get()->session->set('flash_success', 'Профіль митця видалено.');
            }
        }
        return $this->redirect('/virtualgallery/artists/index');
    }
}