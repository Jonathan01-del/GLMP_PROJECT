<?php

function format_email($info, $format){

	//set the root
	$root = $_SERVER['DOCUMENT_ROOT'].'../../public_html/breakout/';

	//grab the template content
	$template = file_get_contents($root.'/first_confirmation_letter.html');
			
	//replace all the tags
	$template = preg_replace('{USERNAME}', $info['username'], $template);
	$template = preg_replace('{EMAIL}', $info['email'], $template);
	$template = preg_replace('{COMPANY}', $info['company'], $template);
	$template = preg_replace('{DELEGATE_ID}', $info['delegate_id'], $template);
		
	//return the html of the template
	return $template;

}

//send the welcome letter
function send_email($info){
		
	//format each email
	$body = format_email($info,'html');
	$body_plain_txt = format_email($info,'txt');

	//setup the mailer
	$transport = Swift_MailTransport::newInstance();
	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance();
	$message ->setSubject('Thank you for confirming your attendance at the EVENTS TECH 2020');
	$message ->setFrom(array('info@globallinkmp.com' => 'EVENTS TECH 2020'));
	$message ->setTo(array($info['email'] => $info['username'],'stephany.bondoy@globallinkmp.com'));
	
	$message ->setBody($body_plain_txt);
	$message ->addPart($body, 'text/html');
			
	$result = $mailer->send($message);
	
	return $result;
	
}
