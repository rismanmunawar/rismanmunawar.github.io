<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["fullname"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Ganti dengan API key SendGrid Anda
    $sendgrid_api_key = "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";

    // Alamat email penerima
    $to = "dmunawarrisman@gmail.com";

    // Subjek email
    $subject = "Pesan dari $full_name";

    // Isi pesan
    $email_body = "Dari: $full_name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Pesan:\n$message";

    // Menggunakan SendGrid PHP library
    require 'vendor/autoload.php';

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom($email, $full_name); // Menggunakan alamat email pengirim yang diambil dari input
    $email->setSubject($subject);
    $email->addTo("dmunawarrisman@gmail.com", "Dede Munawar Risman"); // Ganti dengan alamat email penerima
    $email->addContent("text/plain", $email_body);

    $sendgrid = new \SendGrid($sendgrid_api_key);

    try {
        $response = $sendgrid->send($email);
        if ($response->statusCode() == 202) {
            echo "Email terkirim dengan sukses.";
        } else {
            echo "Gagal mengirim email.";
        }
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
