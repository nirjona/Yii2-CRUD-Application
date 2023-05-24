<?php
namespace app\models;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>
<div class = 'book-class'>
        <?php
           $form = ActiveForm::begin()
        ?>

        <?= $form-> field($posts, 'id')->textInput()?>
        <?= $form-> field($posts, 'post_title')->textInput()?>
        <?= $form-> field($posts, 'genre')->textInput()?>
        <?= $form-> field($posts, 'dept')->textInput()?>
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end()?>
</div>