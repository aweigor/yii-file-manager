<?php

namespace app\models;

use yii\base\Model;

/**
 * FileSearch represents the model behind the search form of `app\models\File`.
 */
class FileUpload extends File
{
    public $fileInstances;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['fileInstances', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @return boolean
     */
    public function upload($file, $folder, $time)
    {
        $uploadDir = 'uploads/storage/'.$folder->fold_id;
        if(!is_dir($uploadDir)) mkdir($uploadDir);
        $fileDir = $uploadDir . '/' . md5($time) . '.' . $file->extension;

        if($file->saveAs($fileDir)) {
            return $fileDir;
        }

        return null;
    }
}
