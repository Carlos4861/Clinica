<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Mailer {
    public static function sendConfirmation($email, $datetime) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your_email@example.com';
            $mail->Password = 'your_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('no-reply@clinic.com', 'Clinic App');
            $mail->addAddress($email);

            $mail->Subject = 'Confirmación de cita';
            $mail->Body = "Su cita está confirmada para: $datetime";

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar correo: {$mail->ErrorInfo}";
        }
    }
}
?>
