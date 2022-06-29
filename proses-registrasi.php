<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['register']))
{
    require_once('koneksi.php');

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "INSERT INTO users(fullname, email, password) VALUES
            ('$fullname', '$email', '$password')");
    if($query)
    {   
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);   

        $email_pengirim = 'eufrondpaduansi@gmail.com';
        $nama_pengirim = 'PT.Frondev';
        $email_penerima = $_POST['email'];
        $subjek = 'Registrasi User Baru PT.Frondev';
        $pesan = 'Halo, ' .$fullname .' anda berhasil registrasi di PT.Frondev dengan email address '. $email . ' & Password ' . $password  ;

        $mail = new PHPMailer();
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $email_pengirim;
        $mail->Password = 'obloeiaoarwktcqh';
        $mail->Port = 465;
        $mail->SMTPAuth= true;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 2;

        $mail->setFrom($email_pengirim, $nama_pengirim);
        $mail->addAddress($email_penerima);
        $mail->isHTML(true);
        $mail->Subject = $subjek;
        $mail->Body = $pesan;

        $send = $mail->send();
        if($send){
            header('Location:index.php?ket=success');
        }else{
            header('Location:index.php?ket=gagal');
        }

    }

}

?>