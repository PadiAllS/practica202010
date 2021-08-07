<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string|null $password
 * @property string|null $authKey
 * @property string|null $accessToken
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name'], 'required'],
            [['username', 'name'], 'string', 'max' => 80],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    public static function findIdentity($id) 
    {
        return self::findOne($id);
    }
    
    public static function findIdentityByAccessToken($token, $type = null) 
    {
        return self::findOne(['accessToken'=>$token]);
        
    }
    
    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    public function getId() 
    {
        return $this->id;
    }
    
    public function getAuthKey(): string 
    {
        return $this->authKey;
        
    }

    public function validateAuthKey($authKey): bool 
    {
        return $this->authKey === $authKey;
        
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }  
          

    
}
