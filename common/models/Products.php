<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $brand_name
 * @property string $description
 * @property string $unit_price
 * @property int $quantity
 * @property string $ws_price
 * @property int $ws_quantity
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_name', 'unit_price', 'quantity'], 'required'],
            [['unit_price', 'ws_price'], 'number'],
            [['quantity', 'ws_quantity'], 'integer'],
            [['brand_name'], 'string', 'max' => 191],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand_name' => 'Brand Name',
            'description' => 'Description',
            'unit_price' => 'Unit Price',
            'quantity' => 'Quantity',
            'ws_price' => 'Ws Price',
            'ws_quantity' => 'Ws Quantity',
        ];
    }
}
