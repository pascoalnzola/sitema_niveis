<?php
    include("Banco_dados/config.php");
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');

    use \PHPMailer\PHPMailer\PHPMailer;
    use \PHPMailer\PHPMailer\SMTP;
    use \PHPMailer\PHPMailer\Exception;
    $mail = new PHPMailer(true);
    
    $email = $_POST['email'];
    $sel = "SELECT * from Usuarios where email = '$email'";
    $res = $conn->query($sel)->fetch(PDO::FETCH_ASSOC);
    $_SESSION["usuario"] = $res['Nome'];
    $_SESSION['email_code'] = $res['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try{
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pascoaltondo.code@gmail.com';
            $mail->Password = 'mpeqoqlfxlxfkyjz';
            $mail->Port = 587;
    
            $mail->setFrom('pascoaltondo.code@gmail.com');
            $mail->addAddress("$email");
    
            $min = 1010;
            $max = 9998;
            $code = mt_rand($min, $max);
            $_SESSION['code_senha'] = $code;
    
            $mail->isHTML(true);
            $mail->Subject = "Codigo de redifinição da senha";
            $mail->Body = "Ola caríssimo o seu código para redifinição de senha é: <strong>$code</strong> introduza este código para redifinires a senha e fazeres o login. Equipa Pascoal Nzola Tondo.";
            $mail->AltBody = "Ola caríssimo o eu código para redifinição de senha é: $code introduza este código para redifinires a senha e fazeres o login. Equipa Pascoal Nzola Tondo.";
            if($mail->send()){
                echo 'email enviado';
                header("Location: code_senha.php");
                
            }
            else{
                echo 'email não enviado';
            }
        }
        catch (Exception $ex){
            echo "<script>alert('Erro ao enviar o código')</script>";
        }
    } else {
        echo "<script>
                alert('Email Inválido!');
            </script>";
            header("Location: login.php");
    }

?>