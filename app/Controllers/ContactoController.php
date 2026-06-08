<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactoController extends BaseController
{
    public function index()
    {
        return view('contacto/index');
    }

    public function envieCorreo()
    {
        $request = service('request');

        $name    = $request->getPost('name');
        $celular = $request->getPost('celular');
        $email   = $request->getPost('email');
        $message = $request->getPost('message');
        $token   = $request->getPost('cf-turnstile-response') ?: $request->getPost('turnstile_token');

        if (empty($token)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Token de Turnstile faltante.']);
        }

        $secret = env('TURNSTILE_SECRET_KEY');
        $verifyUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

        $ch = curl_init($verifyUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['secret' => $secret, 'response' => $token]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $verifyResponse = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($verifyResponse, true);
        if (empty($json) || empty($json['success']) || $json['success'] !== true) {
            return $this->response->setJSON(['success' => false, 'message' => 'Validación Turnstile fallida.']);
        }

        // Enviar correo con PHPMailer
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = env('BREVO_SMTP_USER');
            $mail->Password = env('BREVO_SMTP_PASS');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $from = env('BREVO_FROM_EMAIL') ?: $mail->Username;
            $to = env('BREVO_TO_EMAIL');

            $mail->setFrom($from, 'Contacto Web');
            if ($to) {
                $mail->addAddress($to);
            } else {
                // Si no hay destinatario configurado, devolver error
                return $this->response->setJSON(['success' => false, 'message' => 'No hay destinatario configurado en .env']);
            }

            $mail->addReplyTo($email, $name ?: $email);
            $mail->isHTML(true);
            $mail->Subject = 'Nuevo mensaje de contacto';
            $body = "<p><strong>Nombre:</strong> " . esc($name) . "</p>";
            if ($celular) {
                $body .= "<p><strong>Celular:</strong> " . esc($celular) . "</p>";
            }
            $body .= "<p><strong>Email:</strong> " . esc($email) . "</p>";
            $body .= "<p><strong>Mensaje:</strong><br>" . nl2br(esc($message)) . "</p>";
            $mail->Body = $body;

            $mail->send();
            return $this->response->setJSON(['success' => true, 'message' => 'Correo enviado correctamente.']);
        } catch (Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error al enviar correo: ' . $e->getMessage()]);
        }
    }
}
