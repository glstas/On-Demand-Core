<?php
/**
 * @copyright Reinvently (c) 2018
 * @link http://reinvently.com/
 * @license https://opensource.org/licenses/Apache-2.0 Apache License 2.0
 */

namespace reinvently\ondemand\core\components\loggers\controllers;

use reinvently\ondemand\core\components\loggers\models\ApiLogSearch;
use reinvently\ondemand\core\controllers\admin\AdminController;
use Yii;
use yii\web\HttpException;


class ApiLogController extends AdminController
{
	/**
	 * @return string
	 * @throws HttpException
	 */
	public function actionIndex()
	{
		$searchModel = new ApiLogSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		$data = [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		];

		return $this->render('index', $data);
	}
}