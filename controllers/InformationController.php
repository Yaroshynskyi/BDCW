<?php
namespace controllers;

use core\Controller;

class InformationController extends Controller
{
    public function actionContacts()
    {
        $result = $this->render();
        $result['Title'] = 'Контактна інформація';
        return $result;
    }

    public function actionAbout()
    {
        $result = $this->render();
        $result['Title'] = 'Про проєкт';
        return $result;
    }
}