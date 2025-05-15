<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactosController extends Controller
{
    public function enviarCorreo(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'mensaje' => 'required|string'
        ]);

        try {
            // Configuración de PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = env('MAIL_PORT');

            // Destinatarios
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($request->email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = $request->nombre . ' Mensaje desde: ' . env('APP_NAME');
            $mail->Body = $request->mensaje;
            $mail->AltBody = 'Gracias por tu mensaje';

            // Enviar correo
            $mail->send();
            return response()->json(['msg' => 'Correo enviado, revisa tu bandeja de entrada', 'icono' => 'success']);
        } catch (Exception $e) {
            return response()->json(['msg' => 'Error al enviar correo: ' . $mail->ErrorInfo, 'icono' => 'error']);
        }
    }
}
