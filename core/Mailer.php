<?php

namespace app;

require_once __DIR__ . '/Checker.php';

class Mailer
{
    public static function send($from, $to, $subject, $body)
    {
        $mailer = new \PHPMailer\PHPMailer\PHPMailer(false);
        $mailer->isHTML(true);
        $mailer->isSMTP();
        $mailer->SMTPAuth = true;
        $mailer->CharSet = Config::$smtpCharset;
        $mailer->Host = Config::$smtpHost;
        $mailer->Username = Config::$smtpUser;
        $mailer->Password = Config::$smtpPass;
        $mailer->SMTPSecure = 'ssl';
        $mailer->Port = 465;
        $mailer->Subject = $subject;
        $mailer->Body = $body;
        $mailer->addCustomHeader('X-Priority: 1');
        $mailer->addCustomHeader('X-MSMail-Priority: High');
        $mailer->setFrom($from);
        $mailer->addAddress($to);
        return $mailer->send();
    }
}
