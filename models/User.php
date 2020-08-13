<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use \yii\db\ActiveRecord;
use \yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $user_name
 * @property string|null $user_email
 * @property string $user_pwd
 * @property int|null $user_isAdmin
 * @property string|null $user_datecreate
 * @property string|null $user_datelastlogin
 *
 * @property File[] $files
 * @property Folder[] $folders
 * @property FolderUser[] $folderUsers
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['user_datecreate']
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'user_pwd'], 'required'],
            [['user_isAdmin'], 'integer'],
            [['user_datecreate', 'user_datelastlogin'], 'safe'],
            [['user_name', 'user_email', 'user_pwd'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'user_email' => 'User Email',
            'user_pwd' => 'User Pwd',
            'user_isAdmin' => 'User Is Admin',
            'user_datecreate' => 'User Datecreate',
            'user_datelastlogin' => 'User Datelastlogin',
        ];
    }

    public static function findIdentity($id) {
        return static::find()->where(['user_id' => $id])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        # TODO: implement findIdentityByAccessToken
    }

    public function getId() {
        return $this->user_id;
    }

    public function getAuthKey() {
        # TODO: implement getAuthKey
    }

    public function validateAuthKey($authKey) {
        # TODO: implement validateAuthKey
    }


    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['file_user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Folders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFolders()
    {
        return $this->hasMany(Folder::className(), ['fold_user_id' => 'user_id']);
    }

    public function getSharedFolders()
    {
        return $this->hasMany(Folder::className(), ['fold_id' => 'foldus_folder_id'])
                    ->viaTable('folder_user', ['foldus_user_id' => 'user_id']);
    }

    /**
     * Gets query for [[FolderUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFolderUsers()
    {
        return $this->hasMany(FolderUser::className(), ['foldus_user_id' => 'user_id']);
    }

    public static function findByUsername($username)
    {
        return static::find()->where(['user_name' => $username])->one();
    }

    public function validatePassword($password)
    {
        return $this->user_pwd === $password;
    }

    public function getFriends()
    {
        $sharedOwners = $sharedFolders = [];

        $sharedFolders = $this->getSharedFolders()
            ->select("fold_user_id")
            ->asArray()
            ->all();

        $sharedOwners = ArrayHelper::getColumn($sharedFolders, 'fold_user_id');

        return array_map(function($userId) {
            return self::findOne($userId);
        },array_unique($sharedOwners));
    }

    public function getSharedFoldersByUid($uid) {
        $sharedFolders = $this->getSharedFolders()
            ->select("*")
            ->where(["fold_user_id" => $uid])
            ->all();

        return $sharedFolders;
    }
}
