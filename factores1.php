<?php
    session_start();
    include("Banco_dados/config.php");
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');

    use \PHPMailer\PHPMailer\PHPMailer;
    use \PHPMailer\PHPMailer\Exception;
    $mail = new PHPMailer(true);

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sel = "SELECT nome from usuario where email = '$email'";
    $res = $conn->query($sel)->fetch(PDO::FETCH_ASSOC);
    $_SESSION["usuario"] = $res['nome'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pascoaltondo.code@gmail.com';
            $mail->Password = 'mpeqoqlfxlxfkyjz';
            $mail->Port = 587;
    
            $mail->setFrom('pascoaltondo.code@gmail.com');
            $mail->addAddress("$email");
    
            $min = 1234;
            $max = 9578;
            $code = mt_rand($min, $max);
            $_SESSION['code'] = $code;
    
            $mail->isHTML(true);
            $mail->Subject = "Codigo de autenticar";
            $mail->Body = "Ola caríssimo o seu código de autenticação é: <strong>$code</strong> introduza este código para fazeres o login. Equipa Pascoal Nzola Tondo.";
            $mail->AltBody = "Ola caríssimo o eu código de verificação é: $code introduza este código para fazeres o login. Equipa Pascoal Nzola Tondo.";
            if($mail->send()){
                echo 'email enviado';
                
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
    }
?>