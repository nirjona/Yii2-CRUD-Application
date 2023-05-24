<?php
use \app\controllers\SiteController;
use app\models\Posts;
use yii\helpers\Html as Html;

/** @var yii\web\View $this*/

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Library Management Application</h1>

    </div>
    <div class="body-content">   
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Book ID</th>
      <th scope="col">Book Title</th>
      <th scope="col">Genre</th>
      <th scope="col">Department</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($post as $posts): ?>
    <tr class="table-active">

        <td><?php echo $posts->id ?></td>
        <td><?php echo $posts->post_title ?></td>
        <td><?php echo $posts->genre ?></td>
        <td><?php echo $posts->dept ?></td>
      <td>
          <span><?= Html::a('Create',['create'],['class' => 'btn btn-primary', 'data' => [
                  'method' => 'post',]]) ?></span>
          <span><?= Html::a('Update',['update', 'id' => $posts->id],['class' => 'btn btn-success','data' => [
                  'method' => 'post',]]) ?></span>
          <span><?= Html::a('Delete',['delete', 'id' => $posts->id],['class' => 'btn btn-danger','data' => [
                  'confirm' => 'Are you sure you want to delete this book?',
                  'method' => 'post',]]) ?></span>


      </td>
    </tr>
    <?php endforeach; ?>


  </tbody>
</table>
    </div>

    
</div>
