<?php
use kartik\slider\Slider;
/*
 * This file is part of the 7well project.
 *
 * (c)2015 Julatools project <http://github.com/chd7wells>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm    $form
 * @var julatools\user\models\Config $config
 */

?>

<?= $form->field($practice, 'practicename')->textInput(['maxlength' => 255]) ?>
<?= $form->field($practice, 'expertise')->widget(Slider::classname(), [
'pluginOptions'=>[
'min'=>0,
'max'=>10,
'step'=>1
]
]) ?>
<?= $form->field($practice, 'specifics')->widget(Slider::classname(), [
'pluginOptions'=>[
'min'=>0,
'max'=>10,
'step'=>1
]
]) ?>
<?= $form->field($practice, 'funfactor')->widget(Slider::classname(), [
'pluginOptions'=>[
'min'=>0,
'max'=>10,
'step'=>1
]
]) ?>

    	

