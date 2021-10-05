<?php
 
   $data = $_POST;
 
   $name = $data['name'];
   $email = $data['email'];
   $message = $data['message'];
 
   $dest = isset( $data['dest'] )
      ? $data['dest']
      : 'penhold3r@gmail.com';
 
   $headers = 'From: '. $name .'<'. $email .'>'. "\r\n";
   $headers .= 'X-Mailer: PHP5'. "\n";
   $headers .= 'MIME-Version: 1.0'. "\n";
   $headers .= 'Content-type: text/html; charset=UTF-8'. "\r\n";
 
   $subject = 'Contact message from '. $name;
 
   $body = 'Name: '. $name .'<br/>';
   $body .= 'Email: '. $email .'<br/>';
   $body .= 'Message: '. $message;
 
   mail($dest, '=?UTF-8?B?'. $subject .'?=', $body, $headers);