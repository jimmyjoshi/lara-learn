<?php namespace App\Library\MailSender;

use App\Models\Emailer\Emailer;
use App\Models\MailerLog\MailerLog;

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
        $this->limit = $limit;
    }

    public function sendAllEmails()
    {
        $mailer         = new Emailer;
        $mailerLog      = new MailerLog;
        $successEntries = [];

        $mailers = $mailer->with(['subscriber', 'template'])->where(['send_status' => 0 ])->limit($this->limit)->get();

        foreach($mailers as $mailer) 
        {
            if($this->sendMail($mailer))
            {
                $mailerLogData[] = [
                    'subscriber_id' => $mailer->subscriber_id,
                    'subject'       => $mailer->template->subject,
                    'body'          => $mailer->template->body,
                ];

                $successEntries[] = $mailer->id;
            }
        }
        
        if(count($successEntries))
        {
            $mailerLog->insert($mailerLogData);
            
            if(Emailer::whereIn('id', $successEntries)->update(['send_status' => 1, 'send_at' => date('Y-m-d H:i:s')]))
            {
                return count($successEntries);
            }
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
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Admin <admin@admin.com>';

            if($model->subscriber->email_id && $model->template->subject)
            {
                if(mail($model->subscriber->email_id, $model->template->subject, $model->template->body,$headers))
                {
                    return true;
                }
            }
        }

        return false;
    }
}