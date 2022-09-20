<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fd_fax_details".
 *
 * @property int $id
 * @property string|null $call_id
 * @property string|null $file_name
 */
class FaxDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fd_fax_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['call_id', 'file_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'call_id' => 'Call ID',
            'file_name' => 'File Name',
        ];
    }
}
