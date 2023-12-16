<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use Yii;

class Order extends AppModel
{
    const STATUS_ORDER = [
        0 => 'Новый',
        1 => 'Принят',
        2 => 'Выполнен',
        3 => 'Отменен',
    ];

    const STATUS_PAYMENT = [
        0 => 'Не оплачен',
        1 => 'Оплачен',
    ];

    public static function tableName()
    {
        return 'order';
    }

    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['number', 'date'], 'required'],
            [['number',], 'string', 'max' => 254],
            [['user_name',], 'string', 'max' => 254],
            [['user_phone',], 'string', 'max' => 20],
            [['user_comment',], 'string', 'max' => 1000],
            [['user_id', 'status', 'payment_status', 'date', 'created_at', 'updated_at',], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Номер заказа',
            'status' => 'Статус заказа',
            'payment_status' => 'Статус оплаты',
            'user_id' => 'Пользователь',
            'user_name' => 'Имя',
            'user_phone' => 'Телефон',
            'user_comment' => 'Комментарий',
            'date' => 'Дата',
        ];
    }

    public function getOrderGoods()
    {
        return $this->hasMany(OrderGood::class, ['order_id' => 'id']);
    }

    public function getNameStatus()
    {
        return self::STATUS_ORDER[$this->status];
    }

    public function getNamePaymentStatus()
    {
        return self::STATUS_PAYMENT[$this->payment_status];
    }
}
