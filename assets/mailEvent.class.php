<?php

/**
 * Class mailEvent
 * 
 * @author     Michel Zuidema <michelgzuidema@gmail.com>
 */
class mailEvent {
	private $receiverEmail;
	private $subject;
	private $message;
	private $headers;

	/**
       * 
       * Creëert een nieuw mailEvent object met
       *
       * @param string $receiverEmail  Email van ontvanger
       * @param string $subject  Onderwerp van de email
       * @param string $message  Content van de email
       */
	public function __construct($receiverEmail, $subject, $message) 
	{
		if($receiverEmail != null) {
			$this->receiverEmail = $receiverEmail;
		}
		$this->subject = $subject;
		$this->message = $message;
		$this->headers = 'From: contact@ek2020-voetbal.nl' . "\r\n" . 'Reply-To: 83239@glr.nl' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	}	

	/**
       * 
       * Verstuurd de mail
       *
       * @return boolean
       */
	public function sendMail() 
	{
		if(mail($this->receiverEmail, $this->subject, $this->message, $this->headers)) {
			return true;
		} else {
			return false;
		}
	}

	/**
       * 
       * Pakt alle emails uit een gebruikers lijst en maakt er 1 string van
       *
       * @param array $users  Lijst met gebruikers
       * @return string
       */
	public function addReceiverEmailList($users) 
	{
		$emails = "";
		foreach($users as $user) {
			$emails .= $user['user_email'] . ", ";
		}

		$this->receiverEmail = $emails;
	}
}

?>