<?php

namespace backend\models;

use yii\base\Model;

class Settings extends Model
{

    /* Основные */
    public $email;
    public $phone;
    public $text_about;

    /* SMTP */
    public $smtp_username;
    public $smtp_password;
    public $smtp_host;
    public $smtp_port;
    public $smtp_encrypt;


    /* SEO главной страницы */
    public $h1;
    public $title;
    public $keywords;
    public $description;

    /* Организация */
    public $organization_domain;
    public $organization_name;
    public $organization_address;

    public function rules()
    {
        return [
            [
                [
                    'email',
                    'phone',
                    'text_about',
                    
                    'h1',
                    'title',
                    'keywords',
                    'description',

                    'organization_domain',
                    'organization_name',
                    'organization_address',

                    'smtp_username',
                    'smtp_password',
                    'smtp_host',
                    'smtp_port',
                    'smtp_encrypt',
                ],
                'string',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail для уведомления',
            'phone' => 'Телефон',
            'text_about' => 'Блок информации',

            'h1' => 'H1',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'description' => 'Description',

            'organization_domain' => 'Доменное имя',
            'organization_name' => 'Название организации',
            'organization_address' => 'Адрес организации',

            'smtp_username' => 'Имя пользователя',
            'smtp_password' => 'Пароль',
            'smtp_host' => 'Почтовый сервер (Хост)',
            'smtp_port' => 'Порт сервера',
            'smtp_encrypt' => 'Шифрование',
        ];
    }
}
