<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


try
{
    if (isset($_POST['name']) || isset($_POST['message']) || isset($_POST['email'])) {
    
        //se obtienen los campos de la peticion
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
    
        $error = [];
    
        //validacion de campos obligatorios 
        if (empty($name)) {
            $error['name'] =  "The name field is required.";
        }
        if (empty($email)) {
            $error['email']  =   "The email field is required.";
        }
        if (empty($message)) {
            $error['message']  = "The message field is required.";
        }
    
    
        //validacion de solo caracteres en el nombre 
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error['name'] = "The name can contain only letters";
        }
    
        if (!empty($name)) {
            if (strlen($name) > 50 || strlen($name) < 3) {
                $error['name'] = "The name maximum 50 characters and minum 3 characters";
            }
        }
        //correo valido 
        if (!empty($email)) {
            if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email)) {
                $error['email'] = "The email is not valid";
            }
        }
    
        // si todo esta bien se envia correo 
        if (empty($error)) {
            try {
                sendMailThankYou($email, $name);
            } catch (Exception $ex) {
                echo json_encode($ex->getMessage());
            }
        } else {
            echo json_encode($error);
        }
    }
    
}
catch(Exception $ex){
    echo json_encode("Message could not be sent. Mailer Error: {$ex->getMessage()}");
}

function sendMailThankYou($email, $name)
{
    $mail = new PHPMailer(true);

        $html =  htmlentities(file_get_contents("./thankYou.html", true));
        $templateString = str_replace('%%NAME%%', $name, $html);
        $template = html_entity_decode($templateString);

        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->From = "contact@freshriver.ai";
        $mail->FromName = "Contact";
        $mail->ClearAllRecipients();
        $mail->addAddress($email, $name);
        $mail->Subject = 'Thank You!';
        $mail->msgHTML($template);
        $mail->AltBody = 'Thank You!';
        $mail->SMTPAuth = $_ENV["SMTP_AUTH"];
        $mail->SMTPSecure = $_ENV["SECURE"];
        $mail->Host = $_ENV["HOST"];
        $mail->Port = $_ENV["PORT"];
        $mail->Username = $_ENV["USER_NAME"];
        $mail->Password = $_ENV["PASSWORD"];

        $mail->send();
    // } catch (Exception $e) {
    //     echo json_encode("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    // }
}

function template($name, $email, $message)
{
    $elementReplace  = array();
    $substituteselements = array();

    array_push($elementReplace,'%%NAME%%','%%EMIL%%','%%COMMENTS%%');
    array_push($substituteselements,$name,$email,$message);

    $html =  htmlentities(file_get_contents('./notification.html', true));
    $templateString = str_replace($elementReplace, $substituteselements, $html);
    $template = html_entity_decode($templateString);

    return $template;
}
