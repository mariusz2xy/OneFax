<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dl_dids_list".
 *
 * @property int $id
 * @property string|null $did
 * @property int|null $cl_id
 * @property string $create_date
 * @property int $delete_flag
 * @property string|null $delete_date
 */
class DidsList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dl_dids_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cl_id', 'delete_flag'], 'integer'],
            [['create_date', 'delete_date'], 'safe'],
            [['did'], 'string', 'max' => 15],
            [['did'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'did' => 'Numer',
            'cl_id' => 'Cl ID',
            'create_date' => 'Create Date',
            'delete_flag' => 'Delete Flag',
            'delete_date' => 'Delete Date',
            'clientName' => 'Klient',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(ClientsList::className(), ['id' => 'cl_id']);
    }

    public function getClientName()
    {
        return $this->client->name;
    }
}
