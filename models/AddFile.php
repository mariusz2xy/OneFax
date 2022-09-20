<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class AddFile extends Model
{

    public $file, $caller_number, $called_number;

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'tiff,pdf'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Wybierz plik',
            'caller_number' => 'Numer faxu',
            'called_number' => 'Odbiorca',
        ];
    }
}
