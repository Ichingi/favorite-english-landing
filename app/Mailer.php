<?php
class Mailer
{
    public function sendVerificationEmail($email, $verification_link)
    {
        $to = $email;
        $subject = 'Підтвердження електронної пошти';
        $message = "Дякуємо за реєстрацію!\n\nПерейдіть за посиланням, щоб підтвердити вашу електронну пошту:\n$verification_link";
        
        $headers = "From: support@favorite-english.com\r\n";
        $headers .= "Reply-To: support@favorite-english.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "Лист надіслано: $verification_link до $email";
        } else {
            echo "Не вдалося надіслати лист!";
        }
    }
}
