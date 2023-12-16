<?php

namespace common\models;

class OrderGood extends AppModel
{
    public static function tableName()
    {
        return 'order_good';
    }

    public function rules()
    {
        return [
            [['order_id', 'good_id', 'price', 'quantity'], 'required'],
            [['order_id', 'good_id', 'quantity'], 'integer'],
            [['price'], 'number'],
        
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Заказ',
            'good_id' => 'Товар',
            'price' => 'Цена',
            'quantity' => 'Количество',
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getGood()
    {
        return $this->hasOne(Good::class, ['id' => 'good_id']);
    }
}
