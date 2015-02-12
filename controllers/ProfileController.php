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


class ProfileController extends \yii\web\Controller
{

	public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'rules' => [
								['allow' => true, 'actions' => ['create', 'delete', 'index', 'update', 'details', 'results'], 'roles' => ['@']],
						]
				],
		];
	}
	

    public function actionIndex()
    {
    	$searchModel  = new ProfileSearch ();
    	//$searchModel->query->where('user_ID=' . \Yii::$app->user->getId());
    	$dataProvider = $searchModel->search(\Yii::$app->request->queryParams );
    	return $this->render('index', [
    			'dataProvider' => $dataProvider,
    			'searchModel'  => $searchModel,
    	]);
    }
    

    /**
     * Creates a new Parameter model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$profile = new CorecompProfile();
    	$profile->user_ID = \Yii::$app->user->getId();
    	$profile->created_at = date("Y-m-d H:i:s",time());
    	$this->performAjaxValidation($profile);
    
    	if ($profile->load(\Yii::$app->request->post()) && $profile->save()) {
    		\Yii::$app->getSession()->setFlash('success', \Yii::t('corecomp', 'Profile has been created'));
    		return $this->redirect(['index']);
    	}
    
    	return $this->render('create', [
    			'profile' => $profile
    	]);
    }
    
    /**
     * Deletes an existing Parameter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$this->findModel($id)->delete();
    	return $this->redirect(['index']);
    }
    
    
    /**
     * Updates an existing Parameter.
     * If update is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
    	$model = $this->findModel( $id );
    	if ($model->load ( \Yii::$app->request->post () ) && $model->save ()) {
    		return $this->redirect ( [
    				'index',
    				//'id' => $model->id
    		] );
    	} else {
    		return $this->render ( 'update', [
    				'model' => $model
    		] );
    	}
    }
    
    
  /*  public function actionDetails()
    {
    	$searchModel  = new PracticeSearch ();
    	$dataProvider = $searchModel->search(\Yii::$app->request->queryParams );
    	return $this->render('details', [
    			'dataProvider' => $dataProvider,
    			'searchModel'  => $searchModel,
    	]);
    }
    */
    
    public function actionDetails($id)
    {
    	$searchModel  = new PracticeSearch ($id);
    	$dataProvider = $searchModel->search(\Yii::$app->request->queryParams );
    	if (\Yii::$app->request->post('hasEditable')) {
    		// instantiate your CorecompPractice model for saving
    		$model = CorecompPractice::findOne(['ID'=>$_POST['editableKey']]);
    		// store a default json response as desired by editable
    		$out = Json::encode(['output'=>'', 'message'=>'']);
    		
    		// fetch the first entry in posted data (there should
    		// only be one entry anyway in this array for an
    		// editable submission)
    		// - $posted is the posted data for CorecompPractice without any indexes
    		// - $post is the converted array for single model validation
    		$post = [];
    		$posted = current($_POST['CorecompPractice']);
    		$post['CorecompPractice'] = $posted;
    		$output = '';
    		// load model like any single model validation
    		if ($model->load($post)) {
    			// can save model or do something before saving model
    			if(isset($posted['practicename']))
    			{
    				$model->update(true, ['practicename']);
    			}
    			if(isset($posted['expertise']))
    			{
    				$model->update(true, ['expertise', 'ID']);
    			}
    			if(isset($posted['specifics']))
    			{
    				$model->update(true, ['specifics']);
    			}
    			if(isset($posted['funfactor']))
    			{
    				$model->update(true, ['funfactor']);
    			}
 
    			

    			// custom output to return to be displayed as the editable grid cell
    			// data. Normally this is empty - whereby whatever value is edited by
    			// in the input by user is updated automatically.
    			$output = '';
    		
    			// similarly you can check if the name attribute was posted as well
    			// if (isset($posted['name'])) {
    			//   $output =  ''; // process as you need
    			// }
    			$out = Json::encode(['output'=>$output, 'message'=>'']);
    		}
    		// return ajax json encoded response and exit
    		echo $out;
    		return;
    		
    	}
    	return $this->render('details', [
    			'dataProvider' => $dataProvider,
    			'searchModel'  => $searchModel,
    			'profileID' => $id,
    	]);
    }
    
    public function actionResults($id)
    {
    	$searchModel  = new PracticeSearch ($id);
    	$dataProvider = $searchModel->search(\Yii::$app->request->queryParams );

    	return $this->render('results', [
    			'dataProvider' => $dataProvider,
    			'searchModel'  => $searchModel,
    			'profileID' => $id,
    	]);
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
    	if (($model = CorecompProfile::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
    
    

}