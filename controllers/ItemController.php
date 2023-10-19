<?php

namespace app\controllers;

use app\services\ItemsService;
use Yii;
use yii\web\Response;

class ItemController extends \yii\web\Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    public function actionIndex(int $categoryId = 3, int $limit = 10): array
    {
        return [
            'time' => Yii::getLogger()->getElapsedTime(),
            'result' => ItemsService::getByCategoryIdWithCurrency($categoryId, $limit)
        ];
    }

    public function actionIndex2(int $categoryId = 3, int $limit = 10): array
    {
        return [
            'time' => Yii::getLogger()->getElapsedTime(),
            'result' => ItemsService::getByCategoryId($categoryId, $limit)
        ];
    }

}
