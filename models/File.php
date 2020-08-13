<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $file_id
 * @property string|null $file_dir
 * @property string|null $file_name
 * @property string|null $file_ext
 * @property string|null $file_color
 * @property string|null $file_comment
 * @property string|null $file_dateloaded
 * @property int|null $file_user_id
 * @property int|null $file_fold_id
 * @property int|null $file_isDeleted
 * @property int|null $file_isPersonal
 *
 * @property Folder $fileFold
 * @property User $fileUser
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'file_user_id', 'file_fold_id'], 'integer'],
            [['file_isDeleted', 'file_isPersonal'],'boolean'],
            [['file_comment'], 'string'],
            [['file_dateloaded'], 'safe'],
            [['file_dir', 'file_name', 'file_ext', 'file_color'], 'string', 'max' => 255],
            [['file_id'], 'unique'],
            [['file_fold_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['file_fold_id' => 'fold_id']],
            [['file_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['file_user_id' => 'user_id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'file_dir' => 'Директория',
            'file_name' => 'Имя файла',
            'file_ext' => 'Тип',
            'file_color' => 'Цвет',
            'file_comment' => 'Примечания',
            'file_dateloaded' => 'Дата загрузки',
            'file_user_id' => 'File User ID',
            'file_fold_id' => 'File Fold ID',
            'file_isDeleted' => 'File Is Deleted',
            'file_isPersonal' => 'Личный файл',
        ];
    }

    /**
     * Gets query for [[FileFold]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileFold()
    {
        return $this->hasOne(Folder::className(), ['fold_id' => 'file_fold_id']);
    }

    /**
     * Gets query for [[FileUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'file_user_id']);
    }

    public function remove() {
        $this->file_isDeleted = true;
        return $this->save(false);
    }
}
