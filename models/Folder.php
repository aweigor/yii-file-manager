<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "folder".
 *
 * @property int $fold_id
 * @property int|null $fold_user_id
 * @property string|null $fold_name
 * @property string|null $fold_image
 * @property string|null $fold_desc
 *
 * @property File[] $files
 * @property User $foldUser
 * @property FolderUser[] $folderUsers
 */
class Folder extends \yii\db\ActiveRecord
{
    public $users;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'folder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fold_id', 'fold_user_id'], 'integer'],
            [['fold_desc'], 'string'],
            [['fold_name', 'fold_image'], 'string', 'max' => 255],
            [['fold_id'], 'unique'],
            [['fold_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fold_user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fold_id' => 'ID',
            'fold_user_id' => 'Fold User ID',
            'fold_name' => 'Имя',
            'fold_image' => 'Картинка',
            'fold_desc' => 'Описание',
            'users' => 'Могут просматривать'
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['file_fold_id' => 'fold_id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_id' => 'foldus_user_id'])
                    ->viaTable('folder_user', ['foldus_folder_id' => 'fold_id']);
    }

    public function getSelectedUsers() {
        $selectedIds = $this->getUsers()->select("user_id")->asArray()->all();
        return ArrayHelper::getColumn($selectedIds, 'user_id');
    }

    public function bindUsers($users) {
        if(is_array($users)) {
            foreach ($users as $user_id)
            {
                $user = User::findOne($user_id);
                $this->link('users', $user);
            }
        }
    }

    /**
     * Gets query for [[FoldUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoldUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'fold_user_id']);
    }

    /**
     * Gets query for [[FolderUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFolderUsers()
    {
        return $this->hasMany(FolderUser::className(), ['foldus_folder_id' => 'fold_id']);
    }
}
