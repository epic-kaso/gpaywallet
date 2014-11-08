<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 10/24/2014
 * Time: 4:36 PM
 */

    function send_mail($destination,
                       $subject,
                       $body,
                       $attachment_filename,
                       $attachment_content){

        try{
            $mandrill = new Mandrill('LKeWp7K5lPH7t4yh0_fcRQ');

            $message = array(
                'html' => $body,
                'text' => $body,
                'subject' => $subject,
                'from_email' => 'gadgetswap@supergeeks.com.ng',
                'from_name' => 'Supergeeks Gadget Swap Info',
                'to' => array(
                    array(
                        'email' => $destination
                    )
                ),
                'important' => true,
                'attachments' => array(
                    array(
                        'type' => 'text/plain',
                        'name' => $attachment_filename,
                        'content' => $attachment_content
                    )
                )
            );
            $result = $mandrill->messages->send($message);

            return $result;

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }

    }

    function validate_email($email){
        $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
        return validate_regex($regex,$email);
    }

    function validate_phone($phone){
        $regex = '/^[0-9]{11}$/';
        return validate_regex($regex,$phone);
    }

    function validate_regex($regex,$pattern){
        $response = preg_match($regex,$pattern);
        return $response == 1 ? true : false;
    }

    function send_mail_to_mailist($mail_list_mails,$subject,$body){
        $response = array();
        $body = prepare_html($subject,$body);
        foreach($mail_list_mails as $itm){
            $response[] = send_mail($itm->email,$subject,$body,null,null);
        }
        return $response;
    }

    function prepare_html($subject,$body){
        /* tags: <?-- $subject --?>
           body: <?-- $body --?>
       */
        $page_body = file_get_contents("templates/emails/supergeeks.html");
        return preg_replace(array('/<\?--\s*\$subject\s*--\?>/','/<\?--\s*\$body\s*--\?>/'),
            array($subject,$body),$page_body);
    }
