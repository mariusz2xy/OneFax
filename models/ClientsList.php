<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cl_clients_list".
 *
 * @property int $id
 * @property string|null $name
 * @property string $create_date
 * @property int $delete_flag
 * @property string|null $delete_date
 */
class ClientsList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cl_clients_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_date', 'delete_date'], 'safe'],
            [['delete_flag'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nazwa',
            'create_date' => 'Data utworzenia',
            'delete_flag' => 'Delete Flag',
            'delete_date' => 'Delete Date',
        ];
    }
}
