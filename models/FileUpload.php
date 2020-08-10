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
    public function upload($file)
    {
        $uploadDir = 'uploads/storage' . $file->baseName . '.' . $file->extension;

        if($file->saveAs($uploadDir)) {
            return $uploadDir;
        }

        return null;
    }
}
