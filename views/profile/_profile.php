<?php

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

<?= $form->field($profile, 'profilename')->textInput(['maxlength' => 255]) ?>
<?= $form->field($profile, 'comment')->textInput(['maxlength' => 255]) ?>
