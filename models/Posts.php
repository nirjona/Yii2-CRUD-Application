<?php 
namespace app\models;
use yii\db\ActiveRecord;

     class Posts extends ActiveRecord
     {
        
        public static function tableName()
        {
           return 'post';
        }

         public function rules()
         {
             return [
                 [['id', 'post_title', 'genre', 'dept'], 'required'],
                 [['post_title', 'genre', 'dept'], 'string'],
                 [['id'], 'integer']
             ];
         }
         /**
          * @inheritdoc
          */
         public function attributeLabels()
         {
             return [
                 'id' => 'id',
                 'post_title' => 'post_title',
                 'genre' => 'genre',
                 'dept' => 'dept',

             ];
         }

     }
?>      