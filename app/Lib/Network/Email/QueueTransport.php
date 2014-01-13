<?php

App::uses('AbstractTransport', 'Network/Email');
App::uses('Mail', 'Model');

class QueueTransport extends AbstractTransport {

    public function send(CakeEmail $mail) {
    	$to = implode(array_keys($mail->to()));
    	$subject = mb_decode_mimeheader($mail->subject());
    	$body = implode("\n", $mail->message());
    	$m = new Mail();
    	$m->enqueue($to, $subject, $body);
    }
}

?>