<?php

/*
 * This file is part of the 7well project.
 *
 * (c) Julatools project <http://github.com/chd7well>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var julatools\user\models\User $user
 */

$this->title = Yii::t('corecomp', 'Create a profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('corecomp', 'Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', []) ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'enableAjaxValidation'   => true,
            'enableClientValidation' => false
        ]); ?>

        <?= $this->render('_profile', ['form' => $form, 'profile' => $profile]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('corecomp', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
