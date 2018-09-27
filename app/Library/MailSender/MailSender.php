<?php namespace App\Library\MailSender;

use App\Models\Emailer\Emailer;
use App\Models\MailerLog\MailerLog;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\ServerConfig\ServerConfig;

/**
 * Class MailSender
 *
 * @author Anuj Jaha
 */


class MailSender
{
    protected $limit;

    public function __construct($limit = 100)
    {
        $this->limit            = $limit;
        $this->serverConfig     = new ServerConfig;
    }

    public function sendAllEmails()
    {
        $mailer         = new Emailer;
        $mailerLog      = new MailerLog;

        $successEntries = [];

        $mailers = $mailer->with(['subscriber', 'template'])->where(['send_status' => 0 ])->limit($this->limit)->get();

        foreach($mailers as $mailer)
        {
            $serverInfo = $this->sendMail($mailer);

            if($serverInfo)
            {
                $viewEmail = '';

                if(1 == 1)
                {
                    $mailerId = hasher()->encode($mailer->id);
                    $viewEmail = '<img style="display: none;" src="'.url('/').DIRECTORY_SEPARATOR.'email-read'. DIRECTORY_SEPARATOR .$mailerId.'">';
                }

                $mailerLogData[] = [
                    'subscriber_id' => $mailer->subscriber_id,
                    'subject'       => $mailer->template->subject,
                    'body'          => $mailer->template->body . $viewEmail,
                ];

                Emailer::where('id', $mailer->id)->update(['server_id' => $serverInfo->id, 'send_status' => 1, 'send_at' => date('Y-m-d H:i:s')]);
                $successEntries[] = $mailer->id;
            }
        }

        if(count($successEntries))
        {
            $mailerLog->insert($mailerLogData);
            return $successEntries;
        }

        return false;
    }

    /**
     * SendMail
     *
     * @param object $model
     * @return bool
     */
    public function sendMail($model = null)
    {
        if($model)
        {
            $monthStartDate =  date('Y-m-01- 00:00:00',strtotime('this month'));
            $monthEndDate   =  date('Y-m-t 12:59:59',strtotime('this month'));
            $servers        = $model->user->smtp_server;
            $serverInfo     = false;

            foreach($servers as $server)
            {
                $count = Emailer::where('server_id', $server->id)
                    ->where('created_at','>=', $monthStartDate)
                    ->where('created_at','<=', $monthEndDate)->count();

                if($count < $server->max_limit)
                {
                    $serverInfo = $server;

                    break;
                }
            }

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = $serverInfo->host; // 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = $serverInfo->username;// 'er.anujcygnet@gmail.com';                 // SMTP username
                $mail->Password = $serverInfo->password; //'Cygnet@321';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($serverInfo->set_from, $serverInfo->set_from_name);
                $mail->addAddress($model->subscriber->email_id, $model->subscriber->name);     // Add a recipient
                $mail->addReplyTo($serverInfo->reply_to, $serverInfo->reply_to_name);
                /*$mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');*/

                //Attachments
                /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $model->template->subject;
                $mail->Body    = $model->template->body;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                return $serverInfo;
            } catch (Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                return false;
            }
            /*
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Admin <admin@admin.com>';

            if($model->subscriber->email_id && $model->template->subject)
            {
                if(mail($model->subscriber->email_id, $model->template->subject, $model->template->body,$headers))
                {
                    return true;
                }
            }*/
        }

        return false;
    }
}