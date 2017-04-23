<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    public static function array2string($array){
        return implode(',',$array);
    }
    public static function string2array($string){
        return explode(',',$string);
    }

    public static function addTags($tags)
    {
        if(empty($tags)) return ;

        foreach ($tags as $name)
        {
            $aTag = Tag::find()->where(['name'=>$name])->one();
            $aTagCount = Tag::find()->where(['name'=>$name])->count();

            if(!$aTagCount)
            {
                $tag = new Tag;
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->save();
            }
            else
            {
                $aTag->frequency += 1;
                $aTag->save();
            }
        }
    }

    public static function removeTags($tags)
    {
        if(empty($tags)) return ;

        foreach($tags as $name)
        {
            $aTag = Tag::find()->where(['name'=>$name])->one();
            $aTagCount = Tag::find()->where(['name'=>$name])->count();

            if($aTagCount)
            {
                if($aTagCount && $aTag->frequency<=1)
                {
                    $aTag->delete();
                }
                else
                {
                    $aTag->frequency -= 1;
                    $aTag->save();
                }
            }
        }
    }
    /**
     * 更新标签
     */
    public static function updateTag($oldTag,$newtTag){
        if (!empty($oldTag)||!empty($newtTag)){
            $oldTagArray = self::string2array($oldTag);
            $newtTagArray = self::string2array($newtTag);
            self::addTags(array_values(array_diff($newtTagArray,$oldTagArray)));
            self::removeTags(array_values(array_diff($oldTagArray,$newtTagArray)));
        }
    }


}
