<?php

namespace app\models;

use Yii;
use VK\VK;

/**
 * This is the model class for table "User".
 *
 * @property integer $id
 * @property integer $completed
 * @property integer $canceled
 * @property integer $rep
 * @property integer $point
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['completed', 'canceled', 'rep', 'point'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'completed' => 'Completed',
            'canceled' => 'Canceled',
            'rep' => 'Rep',
            'point' => 'Point',
        ];
    }

    public static function findByVk($id)
    {
        $user = static::find()->where(['id' => $id])->one();

        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public static function getFullName($id)
    {
        $vk = new VK('6210775', 'rMG8O7Gro6QTSQo0WUx3');

        $query = $vk->api('users.get', ['user_ids' => $id, 'fields' => 'firstname']);
        $fullname = $query['response'][0]['first_name'] .' '.$query['response'][0]['last_name'];

        return $fullname;
    }

    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['user_id' => 'id']);
    }
}
