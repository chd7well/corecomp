<?php

/*
 * This file is part of the Jultatools project.
 *
 * (c) Julatools project <http://github.com/julatools>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/**
 * @var yii\web\View                 $this
 * @var julatools\configmanager\models\Parameter    $parameter
 * @var julatools\configmanager\Module         $module
 */

$profile = $model;
$this->title = Yii::t('corecomp', 'Update Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('corecomp', 'Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin([
    'enableAjaxValidation'   => true,
    'enableClientValidation' => false
]); ?>

<?= $this->render('/_alert', []) ?>

<!-- 
<div class="panel panel-default">
    <div class="panel-body">
        <?= Html::submitButton(Yii::t('corecomp', 'Save'), ['class' => 'btn btn-primary btn-sm']) ?>
        
    </div>
</div>-->

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?= $this->render('_profile', ['form' => $form, 'profile' => $profile]) ?>
        <?= Html::submitButton(Yii::t('corecomp', 'Save'), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
</div>






<?php ActiveForm::end(); ?>
