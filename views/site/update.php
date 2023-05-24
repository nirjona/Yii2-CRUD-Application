<?php
namespace app\models;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>
<div class = 'book-class'>
    <?php
    $form = ActiveForm::begin()
    ?>

    <?= $form-> field($book, 'id')->textInput()?>
    <?= $form-> field($book, 'post_title')->textInput()?>
    <?= $form-> field($book, 'genre')->textInput()?>
    <?= $form-> field($book, 'dept')->textInput()?>
    <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end()?>
</div>