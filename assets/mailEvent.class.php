<?php

class mailEvent {
	private $receiverEmail;
	private $subject;
	private $message;
	private $headers;

	public function __construct($receiverEmail, $subject, $message) {
		$this->receiverEmail = $receiverEmail;
		$this->subject = $subject;
		$this->message = $message;
		$this->headers = 'From: 83239@glr.nl' . "\r\n" . 'Reply-To: 83239@glr.nl' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	}	

	public function sendMail() {
		if(mail($this->receiverEmail, $this->subject, $this->message, $this->headers)) {
			return true;
		} else {
			return false;
		}
	}
}

?>