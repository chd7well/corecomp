<?php

/*
 * This file is part of the 7well project (c)2015 by CHD Electronic Engineering, www.chd.at
 *
 * (c) 7well project <http://github.com/chd7well>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use chd7well\corecomp\models\CorecompProfile;
use kartik\slider\Slider;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var chd7well\user\models\UserSearch $searchModel
 */

$this->title = Yii::t('corecomp', 'Results');
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?= Html::encode($this->title) ?> </h1>

<?= $this->render('/_alert', []) ?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns' => [
    [
    'class' => 'kartik\grid\SerialColumn',
    'contentOptions' => ['class' => 'kartik-sheet-style'],
    'width' => '40px',
    'header' => '',
    'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
    
    [
    //'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'practicename',
    
    'vAlign' => 'middle',
    'width' => '220px',

    ],
    [
    //'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'expertise',

    'vAlign' => 'middle',
    'width' => '220px',
    		

    ],
    
    [
    //'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'specifics',
   
    'vAlign' => 'middle',
    'width' => '220px',

    ],
    [
   // 'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'funfactor',
   
    'vAlign' => 'middle',
    'width' => '220px',

    ],
    [
    // 'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'competence',
    'format'=>'raw',
    'value' => function ($model, $key, $index, $widget) {
    	return Slider::widget([
'name'=>'competence',
'value'=>$model->competence,
'sliderColor'=>Slider::TYPE_GREY,
'handleColor'=>Slider::TYPE_DANGER,
'pluginOptions'=>[
		'min'=>0,
		'max'=>30,
'handle'=>'triangle',
		'enabled'=>false,
'tooltip'=>'always'
]
]);
    },
    'vAlign' => 'middle',
    'width' => '220px',
    
    ],
    /*[
    'class' => 'kartik\grid\FormulaColumn',
    'header' => 'Sum',
    		//'refreshGrid' => true,
    //'vAlign' => 'middle',
    'value' => function ($model, $key, $index, $widget) {
    	$p = compact('model', 'key', 'index');
    	return $widget->col(2, $p) + $widget->col(3, $p) + $widget->col(4, $p);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'],
    //'hAlign' => 'right',
    'width' => '8%',
    'format' => ['decimal', 0],
    //'mergeHeader' => true,
    //'pageSummary' => true,
    //'footer' => true
    ],*/

    ],
    'responsive'=>true,
    'hover'=>true,
    'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo,
    'toolbar' => [
    		/*['content'=>
    				//Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>Yii::t('corecomp', 'Add Practice'), 'class'=>'btn btn-success', ])
    				Html::a(Yii::t('corecomp', 'Add Practice'), ['practice/create', 'id' => $profileID], ['class' => 'btn btn-success'])
    		],*/
    		'{export}',
    		'{toggleData}',
    ],
    
    'export' => [
    		'fontAwesome' => true
    ],
    // parameters from the demo form
    'bordered' => false,

    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'showPageSummary' => false,
    'panel' => [
    		'type' => GridView::TYPE_PRIMARY,
    		'heading' => true,
    ],
    
        
   
]); ?>

<?php Pjax::end() ?>
