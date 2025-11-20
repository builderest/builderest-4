<?php
namespace App\Helpers;

class Mailer
{
    public static function send(string $to, string $subject, string $body): bool
    {
        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        $headers[] = 'From: ' . (MAIL_FROM_NAME ?? 'Builderest') . ' <' . MAIL_FROM_ADDRESS . '>';
        $headers[] = 'Reply-To: ' . MAIL_FROM_ADDRESS;

        return mail($to, $subject, $body, implode("\r\n", $headers));
    }
}
