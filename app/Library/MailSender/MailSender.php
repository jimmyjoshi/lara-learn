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

        $mailers = $mailer->with(['subscriber', 'template'])->where(['send_status' => 0 ])
        ->whereHas('subscriber', function($q)
        {
            $q->where('email_id', '!=', null);
        })
        ->limit($this->limit)->get();

        foreach($mailers as $mailer)
        {
            $serverInfo = $this->sendMail($mailer);

            if($serverInfo)
            {
                $body = access()->addMailerSignature($mailer, $mailer->template->body);

                $mailerLogData[] = [
                    'subscriber_id' => $mailer->subscriber_id,
                    'mailer_id'     => $mailer->id,
                    'subject'       => $mailer->template->subject,
                    'body'          => $body,
                ];

                Emailer::where('id', $mailer->id)->update(['server_id' => $serverInfo->id, 'send_status' => 1, 'send_at' => date('Y-m-d H:i:s')]);
                $successEntries[] = $mailer->id;
            }
            else
            {
                $mailerLog->create([
                    'subscriber_id' => $mailer->subscriber_id,
                    'mailer_id'     => $mailer->id,
                    'is_fail'       => 1,
                    'subject'       => $mailer->template->subject,
                    'body'          => access()->addMailerSignature($mailer, $mailer->template->body),
                    'fail_at'       => date('Y-m-d H:i:s')
                ]);

                Emailer::where('id', $mailer->id)->update([
                    'server_id'     => 0,
                    'send_status'   => 1,
                    'is_fail'       => 1,
                    'fail_at'       => date('Y-m-d H:i:s')
                ]);
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
                $mail->SMTPDebug = 0; // Enable verbose debug output
                $mail->isSMTP();      // Set mailer to use SMTP
                $mail->Host = $serverInfo->host;   // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;          // Enable SMTP authentication
                $mail->Username = $serverInfo->username;   // SMTP username
                $mail->Password = $serverInfo->password;    // SMTP password
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;         // TCP port to connect to

                //Recipients
                $mail->setFrom($serverInfo->set_from, $serverInfo->set_from_name);
                $mail->addAddress($model->subscriber->email_id, $model->subscriber->name);     // Add a recipient
                $mail->addReplyTo($serverInfo->reply_to, $serverInfo->reply_to_name);

                //Attachments
                /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

                //Content
                $mail->isHTML(true);
                $mail->Subject = $model->template->subject;
                $body          = access()->addMailerSignature($model, $model->template->body);
                $mail->Body    = $body;

                if($mail->send())
                {
                    return $serverInfo;
                }
                return false;
            } catch (Exception $e)
            {
                return false;
            }
        }

        return false;
    }
}