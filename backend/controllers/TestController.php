<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\web\Controller;
use common\models\Tag;

class TestController extends Controller
{

    public function actionTest(){
        $tags = ['Yii','Yii2'];

        $tag = Tag::find()->where(['in','name',$tags])
            ->select(['name','frequency'])
            ->column();
        var_dump($tag);
        $different = array_diff($tags,$tag);
        var_dump( $different );
        $intersect = array_intersect($tags,$tag);
        var_dump($intersect);
    }
    public function actionTest1(){
        $tags = ['Yii','Yii2'];
        $t = Tag::find()->where(['in','name',$tags])->all();
//        $t['Yii']->frequency += 1;
//        $t['Yii']->save();exit;
//        var_dump($t['Yii']->frequency);
//
//        var_dump($t['Yii']->attributes());
        foreach ($t as $k=>$v){
            var_dump($k);
        }
        //var_dump($t);
    }
}
