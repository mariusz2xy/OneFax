<?php
namespace app\models;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Users extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'us_users';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    public function rules()
    {
        return [
            [['username', 'password', 'user_group_id'], 'required'],
            [['user_group_id', 'cl_id'], 'integer'],
            [['create_date', 'clientName', 'groupName'], 'safe'],
            [['username', 'auth_key', 'access_token', 'delete_flag'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['user_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserGroups::className(), 'targetAttribute' => ['user_group_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'Imię',
            'lastName' => 'Nazwisko',
            'username' => 'Nazwa użytkownika',
            'password' => 'Hasło',
            'authKey' => 'Auth Key',
            'cl_id' => 'Klient',
            'user_group_id' => 'Uprawnienia',
            'groupName' => 'Uprawnienia',
            'clientName' => 'Klient',
        ];
    }

     public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedException();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }  

    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password)
    {
        try{
            $result = \yii::$app->getSecurity()->validatePassword($password, $this->password);
        } 
        catch(\yii\base\InvalidArgumentException $blad){
            $result = ($this->password === $password)?true:false;
        }
        return $result;
    }

    public function getUserGroups()
    {
        return $this->hasOne(UserGroups::className(), ['id' => 'user_group_id']);
    }

    public function getGroupName()
    {
        return $this->userGroups->name;
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
