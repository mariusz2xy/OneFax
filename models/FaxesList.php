<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fl_faxes_list".
 *
 * @property int $id
 * @property string|null $caller_number
 * @property string|null $called_number
 * @property string|null $direction
 * @property string|null $call_id
 * @property int|null $cl_id
 * @property string|null $event
 * @property string|null $description
 * @property string|null $type
 * @property string $date
 * @property int $delete_flag
 * @property string|null $delete_date
 */
class FaxesList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    // public $fileName;
    public static function tableName()
    {
        return 'fl_faxes_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cl_id', 'delete_flag'], 'integer'],
            [['date', 'delete_date'], 'safe'],
            [['caller_number', 'called_number', 'direction', 'event'], 'string', 'max' => 50],
            [['call_id'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 150],
            [['type'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caller_number' => 'Nadawca',
            'called_number' => 'Odbiorca',
            'direction' => 'Rodzaj',
            'call_id' => 'Call ID',
            'cl_id' => 'Cl ID',
            'event' => 'Status',
            'description' => 'Opis',
            'type' => 'Typ',
            'date' => 'Data',
            'delete_flag' => 'Delete Flag',
            'delete_date' => 'Delete Date',
        ];
    }

    public function getFaxDetails()
    {
        return $this->hasOne(FaxDetails::className(), ['call_id' => 'call_id']);
    }

    public function getFileName()
    {
        return $this->faxDetails->file_name;
    }

}
