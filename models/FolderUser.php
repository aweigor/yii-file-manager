<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "folder_user".
 *
 * @property int $foldus_id
 * @property int|null $foldus_user_id
 * @property int|null $foldus_folder_id
 *
 * @property Folder $foldusFolder
 * @property User $foldusUser
 */
class FolderUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'folder_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['foldus_id'], 'required'],
            [['foldus_id', 'foldus_user_id', 'foldus_folder_id'], 'integer'],
            [['foldus_id'], 'unique'],
            [['foldus_folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['foldus_folder_id' => 'fold_id']],
            [['foldus_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['foldus_user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'foldus_id' => 'Foldus ID',
            'foldus_user_id' => 'Foldus User ID',
            'foldus_folder_id' => 'Foldus Folder ID',
        ];
    }

    /**
     * Gets query for [[FoldusFolder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoldusFolder()
    {
        return $this->hasOne(Folder::className(), ['fold_id' => 'foldus_folder_id']);
    }

    /**
     * Gets query for [[FoldusUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoldusUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'foldus_user_id']);
    }
}
