<?php

namespace chd7well\corecomp\controllers;
use chd7well\corecomp\models\ProfileSearch;
use chd7well\corecomp\models\CorecompProfile;
use chd7well\corecomp\models\PracticeSearch;
use chd7well\corecomp\models\CorecompPractice;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\Json;
use yii\filters\AccessControl;


class PracticeController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'rules' => [
								['allow' => true, 'actions' => ['create', 'delete', 'index'], 'roles' => ['@']],
						]
				],
		];
	}


    /**
     * Creates a new Parameter model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
    	$practice = new CorecompPractice();
    	$practice->profile_ID = $id;
    	
    	$this->performAjaxValidation($practice);
    
    	if ($practice->load(\Yii::$app->request->post()) && $practice->save()) {
    		\Yii::$app->getSession()->setFlash('success', \Yii::t('corecomp', 'Practice has been created'));
    		return $this->redirect(['profile/details', 'id'=>$id]);
    	}

    	return $this->render('create', [
    			'practice' => $practice
    	]);
    }
    
    /**
     * Deletes an existing Parameter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionDelete($id, $profile_ID)
    {
    	$this->findModel($id)->delete();
    	return $this->redirect(['profile/index', 'id'=>$profile_ID]);
    }
    
    
    /**
     * Performs AJAX validation.
     * @param array|Model $models
     * @throws \yii\base\ExitException
     */
    protected function performAjaxValidation($models)
    {
    	if (\Yii::$app->request->isAjax) {
    		if (is_array($models)) {
    			$result = [];
    			foreach ($models as $model) {
    				if ($model->load(\Yii::$app->request->post())) {
    					\Yii::$app->response->format = Response::FORMAT_JSON;
    					$result = array_merge($result, ActiveForm::validate($model));
    				}
    			}
    			echo json_encode($result);
    			\Yii::$app->end();
    		} else {
    			if ($models->load(\Yii::$app->request->post())) {
    				\Yii::$app->response->format = Response::FORMAT_JSON;
    				echo json_encode(ActiveForm::validate($models));
    				\Yii::$app->end();
    			}
    		}
    	}
    }
    
    /**
     * Finds the Parameter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	if (($model = CorecompPractice::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
    
    

}