<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $gender
 * @property string $credit_limit
 *
 * @property Sales[] $sales
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'credit_limit'], 'required'],
            [['credit_limit'], 'number'],
            [['name'], 'string', 'max' => 191],
            [['address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 11],
            [['gender'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'gender' => 'Gender',
            'credit_limit' => 'Credit Limit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::className(), ['customer_id' => 'id']);
    }
}
