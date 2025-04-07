<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class task7{
  public $mail , $email;
  public function setvalue(){
    $this->email = $_POST['email'];
    $this->mail = new PHPMailer(true); 
  }
  public function settings(){
    try {
      //Server settings
      $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
      $this->mail->isSMTP();                                            
      $this->mail->Host       = 'smtp.gmail.com';                     
      $this->mail->SMTPAuth   = true;                                   
      $this->mail->Username   = 'divyatest167@gmail.com';                     
      $this->mail->Password   = 'tempory_mail';                               
      $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
      $this->mail->Port       = 587;                                    
  
      //Recipients
      $this->mail->setFrom('divyatest167@gmail.com', 'Divya');
      $this->mail->addAddress($this->email, 'User');                    
      $this->mail->addReplyTo('info@example.com', 'Information');

      //Content
      $this->mail->isHTML(true);                                  
      $this->mail->Subject = 'Welcome to Email';
      $this->mail->Body    = 'Thank you for visiting.';
      $this->mail->AltBody = 'Thank you for visiting.';
  
      $this->mail->send();
      echo '<span style="color:green">Message has been sent.</span>';
  } catch (Exception $e) {
      echo '<span style="color:red">Message could not be sent. Mailer Error:'. $this->mail->ErrorInfo. '</span>';
  }
 }
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
  if(isset($_POST['email'])){
    $obj = new task7();
    $obj->setvalue();
    $obj->settings();
  }
  else{
    echo '<span style="color:red">Please provide an Email.</span>';
  }
}
?>