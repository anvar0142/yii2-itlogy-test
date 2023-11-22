<?php

namespace backend\models;
/**
 * This is the model class for table "lessons".
 *
 * @property int $id
 * @property string $video_link
 * @property int|null $status
 * @property string $title
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_link', 'title'], 'required'],
            [['status'], 'integer'],
            [['video_link', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_link' => 'Video Link',
            'status' => 'Status',
            'title' => 'Title',
        ];
    }
}
