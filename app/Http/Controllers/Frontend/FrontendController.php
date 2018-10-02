<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Subscriber\EloquentSubscriberRepository;
use App\Models\MailerLog\MailerLog;
use Illuminate\Http\Request;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $repo = new EloquentSubscriberRepository;
        return view('frontend.index')->with(['repository' => $repo]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

    /**
     * Read Sent Mail
     *
     * @param int $id
     * @return bool
     */
    public function readSentMail($id = null)
    {
        return MailerLog::where('mailer_id', $id)->update([
            'read_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function uploadImage(Request $request)
    {
        if($request->file('image'))
        {
            $file = $request->file('image');
            $filename       = time() . '.' . $file->getClientOriginalExtension();
            $destination    = public_path('uploads/images/');

            if($file->move($destination, $filename))
            {
                $imageUrl   = URL('uploads/images/'. $filename);

                echo "<script>top.$('.mce-btn.mce-open').parent().find('.mce-textbox').val('".$imageUrl."').closest('.mce-window').find('.mce-primary').click();</script>".$imageUrl;
                die;
            }

        }
        echo "<script>alert('Unable to Upload Image !');</script>";
        die;
    }
}
