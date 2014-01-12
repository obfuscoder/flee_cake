<?php

App::uses('AbstractTransport', 'Network/Email');
App::uses('Mail', 'Model');

class QueueTransport extends AbstractTransport {

    public function send(CakeEmail $mail) {
    	$to = array_keys($mail->to())[0];
    	$subject = $mail->subject();
    	$body = implode("\n", $mail->message());
    	(new Mail())->enqueue($to, $subject, $body);
    }
}

?>