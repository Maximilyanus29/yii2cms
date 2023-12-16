<?php

namespace common\components\Mail;

use Yii;
use yii\base\Component;
use yii\swiftmailer\Mailer;

class Mail extends Component {

    public static function getMailer()
    {
        $settings = Yii::$app->settings;
        $settings->clearCache();
        
        $host  = $settings->get('Settings.smtp_host');
        $username  = $settings->get('Settings.smtp_username');
        $password  = $settings->get('Settings.smtp_password');
        $post = $settings->get('Settings.smtp_port');
        $encryption = $settings->get('Settings.smtp_encrypt');

        $mailer = Yii::createObject([
            'class' => Mailer::class,
            'useFileTransport' => false,
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' =>  $host, 
                'username' => $username,
                'password' => $password,
                'port' =>  $post, 
                'encryption' => $encryption, 
            ],
        ]);

        return $mailer;
    }
}
