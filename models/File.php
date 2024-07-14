<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class File extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $file;

    public static function tableName()
    {
        return 'files';
    }

    public function rules()
    {
        return [
            [['name', 'path'], 'required'],
            [['name', 'path'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, pdf, doc, docx'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            $this->path = 'uploads/' . $this->file->baseName . '.' . $this->file->extension;
            return true;
        } else {
            return false;
        }
    }
}
