<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pb_phonebook".
 *
 * @property int $id
 * @property int|null $cl_id
 * @property string|null $number
 * @property string|null $description
 * @property string|null $create_date
 * @property string $delete_flag
 * @property string|null $delete_date
 */
class Phonebook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pb_phonebook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cl_id'], 'integer'],
            [['create_date', 'delete_date'], 'safe'],
            [['number'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 50],
            [['delete_flag'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cl_id' => 'ID Klienta',
            'number' => 'Numer',
            'description' => 'Opis',
            'create_date' => 'Data utworzenia',
            'delete_flag' => 'Delete Flag',
            'delete_date' => 'Delete Date',
        ];
    }
}
