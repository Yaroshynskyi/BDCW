<?php

namespace controllers;
use core\Controller;
use core\Core;
use models\Users;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if (Users::IsUserLogged()) return $this->redirect('/virtualgallery/');
        
        if ($this->isPost) {
            $user = Users::FindByLoginAndPassword($this->post->get('login'), $this->post->get('password'));
            if (!empty($user)) {
                Users::LoginUser($user);
                return $this->redirect('/virtualgallery/');
            } else {
                $this->addErrorMessage('Неправильний логін і/або пароль');
            }
        }
        return $this->render();
    }

    public function actionLogout()
    {
        Users::LogoutUser();
        return $this->redirect('/virtualgallery/users/login');
    }

    public function actionRegister()
    {
        if ($this->isPost) {
            $user = Users::FindByLogin($this->post->get('login'));
            if (!empty($user)) $this->addErrorMessage('Користувач із таким логіном вже існує');
            if (strlen($this->post->get('login')) === 0) $this->addErrorMessage('Логін не вказано');
            if ($this->post->get('password') != $this->post->get('password2')) $this->addErrorMessage('Паролі не співпадають');
            if (strlen($this->post->get('password')) === 0) $this->addErrorMessage('Пароль не вказано');
            if (strlen($this->post->get('password2')) === 0) $this->addErrorMessage('Пароль(ще раз) не вказано');
            if (strlen($this->post->get('lastname')) === 0) $this->addErrorMessage('Прізвище не вказано');
            if (strlen($this->post->get('firstname')) === 0) $this->addErrorMessage("Ім'я не вказано");
            
            if (!$this->isErrorMessageExists()) {
                Users::RegisterUser($this->post->get('login'), $this->post->get('password'), $this->post->get('lastname'), $this->post->get('firstname'));
                return $this->redirect("/virtualgallery/users/registersuccess");
            }
        }
        return $this->render();
    }

    public function actionRegistersuccess()
    {
        return $this->render();
    }

    public function actionIndex()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/virtualgallery/users/login');
        }
        return $this->render();
    }

  public function actionProfile()
    {
        if (!Users::IsUserLogged()) {
            return $this->redirect('/virtualgallery/users/login');
        }

        $user = \core\Core::get()->session->get('user');
        // Тепер замість замовлень витягуємо улюблені картини
        $favorites = \models\Favorites::getFavoritesByUserId($user['id']);
        
        $this->template->setParam('user', $user);
        $this->template->setParam('favorites', $favorites);
        
        $result = $this->render();
        $result['Title'] = 'Особистий профіль';
        return $result;
    }

    public function actionUpdateProfile()
    {
        if (!Users::IsUserLogged()) return $this->redirect('/virtualgallery/users/login');

        $user = \core\Core::get()->session->get('user');

        if ($this->isPost) {
            $firstName = $this->post->get('firstname');
            $lastName = $this->post->get('lastname');
            $password = $this->post->get('password'); 

            if (empty($firstName) || empty($lastName)) {
                $this->addErrorMessage('Ім\'я та прізвище є обов\'язковими');
            }

            if (!$this->isErrorMessageExists()) {
                $newData = [
                    'firstName' => $firstName,
                    'lastName' => $lastName
                ];

                if (!empty($password)) {
                    $newData['password'] = $password;
                }

                Users::updateUserById($user['id'], $newData);

                $user['firstName'] = $firstName;
                $user['lastName'] = $lastName;
                if (!empty($password)) $user['password'] = $password;
                \core\Core::get()->session->set('user', $user);

                \core\Core::get()->session->set('flash_success', 'Дані профілю успішно оновлено!');
                return $this->redirect('/virtualgallery/users/profile');
            }
        }

        $this->template->setParam('user', $user);
        $result = $this->render();
        $result['Title'] = 'Редагування профілю';
        return $result;
    }
}