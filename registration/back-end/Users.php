<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property integer $city_id
 * @property integer $gender_id
 * @property integer $age_id
 * @property string $birthdate
 * @property string $email
 * @property string $password
 * @property integer $reputation
 * @property string $user_info
 *
 * @property ReputationHistory[] $reputationHistories
 * @property ReputationHistory[] $reputationHistories0
 * @property Requests[] $requests
 * @property RequestsSubscribers[] $requestsSubscribers
 * @property Responses[] $responses
 * @property ShopsUsers[] $shopsUsers
 * @property Cities $city
 * @property Genders $gender
 * @property Ages $age
 * @property UsersReactions[] $usersReactions
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email'], 'unique'],
            [['city_id', 'gender_id', 'age_id', 'reputation'], 'integer'],
            [['birthdate'], 'safe'],
            [['name', 'email', 'password'], 'string', 'max' => 100],
            [['user_info'], 'string', 'max' => 1000],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genders::className(), 'targetAttribute' => ['gender_id' => 'id']],
            [['age_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ages::className(), 'targetAttribute' => ['age_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'city_id' => 'City ID',
            'gender_id' => 'Gender ID',
            'age_id' => 'Age ID',
            'birthdate' => 'Birthdate',
            'email' => 'Email',
            'password' => 'Password',
            'reputation' => 'Reputation',
            'user_info' => 'User Info',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReputationHistories()
    {
        return $this->hasMany(ReputationHistory::className(), ['voting_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReputationHistories0()
    {
        return $this->hasMany(ReputationHistory::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Requests::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestsSubscribers()
    {
        return $this->hasMany(RequestsSubscribers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopsUsers()
    {
        return $this->hasMany(ShopsUsers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Genders::className(), ['id' => 'gender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAge()
    {
        return $this->hasOne(Ages::className(), ['id' => 'age_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersReactions()
    {
        return $this->hasMany(UsersReactions::className(), ['user_id' => 'id']);
    }
	
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = md5(md5($this->password) . md5('sweetness'));
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
		//to relations behavior
        if (Yii::$app->request->post()['isShopOwner']) {
            if ($insert) {
                $shop = new Shops();
                $shop->date_create = date('Y-m-d H:i:s');
                $shop->is_approved = 0;
				if ($shop->save()) {
					$shopUser = new ShopsUsers();
					$shopUser->user_id = $this->id;
					$shopUser->role_id = 1;
					$shopUser->shop_id = $shop->id;
					$shopUser->save();
				}
            }
        }

    }
}