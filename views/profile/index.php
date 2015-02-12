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
use yii\grid\GridView;
use yii\widgets\Pjax;
use chd7well\user\models\User;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var chd7well\user\models\UserSearch $searchModel
 */

$this->title = Yii::t('corecomp', 'Manage profiles');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    'profilename',



        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                return Yii::t('corecomp', '{0, date, MMMM dd, YYYY HH:mm}', strtotime($model->created_at));
            }
        ],
		'comment',
        [
        	'header' => Yii::t('corecomp', 'Edit'),
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
        [
        'header' => Yii::t('corecomp', 'Practice'),
        'value' => function ($model) {
        	return Html::a(Yii::t('corecomp', 'Edit Practice'), ['details', 'id' => $model->ID], [
        			'class' => 'btn btn-xs btn-success btn-block',
        			'data-method' => 'post',
        	]);
        
        },
        'format' => 'html',
        ],
        [
        'header' => Yii::t('corecomp', 'Results'),
        'value' => function ($model) {
        	return Html::a(Yii::t('corecomp', 'View Results'), ['results', 'id' => $model->ID], [
        			'class' => 'btn btn-xs btn-success btn-block',
        			'data-method' => 'post',
        	]);
        
        },
        'format' => 'html',
        ],
    ];
if(\Yii::$app->user->identity->getIsAdmin())
{
	$userlist[] =     ['attribute' => 'user_ID',
    'value' => function ($model) {
                $user = User::findOne(['id'=>$model->user_ID]);
                return $user->username . ' / ' . $user->email;
            },
 	];
	$columns = array_merge($columns, $userlist);
}

?>
<h1><?= Html::encode($this->title) ?> <?= Html::a(Yii::t('corecomp', 'Create a profile'), ['create'], ['class' => 'btn btn-success']) ?></h1>

<?= $this->render('/_alert', []) ?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'layout'  => "{items}\n{pager}",
    'columns' => $columns,
]); ?>

<?php Pjax::end() ?>
