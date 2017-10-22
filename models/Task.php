<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Task".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $date
 * @property string $location
 * @property integer $people_count
 * @property integer $point
 * @property integer $user_id
 * @property integer $status_id
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Task';
    }

    /**
     * @inheritdoc
     */


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Описание',
            'date' => 'Date',
            'location' => 'Район',
            'people_count' => 'Кол-во участников',
            'point' => 'Баллы (каждому участнику)',
            'user_id' => 'User ID',
        ];
    }

    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
