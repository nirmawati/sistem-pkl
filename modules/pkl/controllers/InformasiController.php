<?php

namespace app\modules\pkl\controllers;

use yii\web\Controller;

/**
 * Default controller for the `informasi` module
 */
class InformasiController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
