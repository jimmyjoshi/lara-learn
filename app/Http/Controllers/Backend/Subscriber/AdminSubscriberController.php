<?php

namespace App\Http\Controllers\Backend\Subscriber;

use App\Http\Controllers\Controller;
use App\Library\MailSender\MailSender;
use App\Library\ModuleGenerator\ModuleGenerator;
use App\Repositories\Subscriber\EloquentSubscriberRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Image;
use Yajra\Datatables\Facades\Datatables;

/**
 * Class AdminSubscriberController
 */
class AdminSubscriberController extends Controller
{
	/**
	 * Repository
	 *
	 * @var object
	 */
	public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "Subscriber Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "Subscriber Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "Subscriber Deleted Successfully";

	/**
	 * __construct
	 *
	 * @param EloquentSubscriberRepository $repository
	 */
	public function __construct(EloquentSubscriberRepository $repository)
	{
        $this->repository = $repository;
	}

    /**
     * Subscriber Listing
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->repository->setAdmin(true)->getModuleView('listView'))->with([
            'repository' => $this->repository
        ]);
    }

    /**
     * Subscriber View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository' => $this->repository
        ]);
    }

    /**
     * Subscriber View
     *
     * @return \Illuminate\View\View
     */
    public function upload(Request $request)
    {
        return view($this->repository->setAdmin(true)->getModuleView('uploadView'))->with([
            'repository' => $this->repository
        ]);
    }

    /**
     * Subscriber View
     *
     * @return \Illuminate\View\View
     */
    public function uploadImage(Request $request)
    {
        dd($request->all());
    }

    public function uploadStore(Request $request)
    {
        if ($request->hasFile('csv'))
        {
            $allSubscribers = $this->repository->model->all();
            $file           = $request->file('csv');
            $filename       = time() . '.' . $file->getClientOriginalExtension();
            $destination    = public_path('uploads/csv/');

            if($file->move($destination, $file->getClientOriginalName()))
            {
                $uploadedFile   = $destination . $file->getClientOriginalName();
                $csvFile        = fopen($uploadedFile, "r");
                $userData       = [];
                $data           = [];

                $sr = 0;
                while(($data = fgetcsv($csvFile, 1000, ",")) !==FALSE )
                {
                    if($sr > 0)
                    {
                        $userData[] = $data;
                    }

                    $sr++;
                }

                fclose($csvFile);

                $userData = collect($userData);
                $newUsers = [];

                foreach($userData as $tempUser)
                {
                    $isExists = $allSubscribers->where('email_id', $tempUser[1])->first();

                    if(! isset($isExists))
                    {
                        $newUsers[] = [
                            'user_id'       => 1,
                            'category_id'   => $tempUser[0],
                            'company_name'  => $tempUser[1],
                            'name'          => $tempUser[2],
                            'mobile'        => $tempUser[3],
                            'email_id'      => $tempUser[4]
                        ];
                    }
                }

                $status     = $this->repository->model->insert($newUsers);
                $message    = count($newUsers) . " Records Inserted Successfully:";

                return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($message);
            }
        }
    }

    public function show()
    {

    }

    /**
     * Store View
     * Subscriber
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image'))
        {
            $image      = $request->file('image');
            $filename   = time() . '.' . $image->getClientOriginalExtension();
            $otherSize  = rand(11111, 99999) . '_' .time() . '.' . $image->getClientOriginalExtension();
            $thumbnail  = rand(11111, 99999) . '_' .time() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->fit(600)->save(public_path('images/blog/' . $filename . '-thumbs.jpg'));

            $width = 600;
            $destination = public_path('images/blog/' . $filename . 'other--thumbs.jpg');
            $image = imagecreatefromjpeg($image);
            $imgW = imagesx($image);
            $imgH = imagesy($image);

            $height = floor($imgH * (640 / $imgW));

            $thumb = imagecreatetruecolor($width, $height);
            imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $imgW, $imgH);
            imagejpeg($thumb, $destination);


            dd(getimagesize($request->file('image')));

            // Resize Image with Thumbnail
            /*Image::make($image)->resize(600, 390)->save(public_path('images/blog/' . $filename));
            Image::make($image)->fit(350)->save(public_path('images/blog/' . $filename . '-thumbs.jpg'));

            // Resize Image with Thumbnail
            Image::make($image)->resize(450, 293)->save(public_path('images/blog/' . $otherSize));
            Image::make($image)->fit(200)->save(public_path('images/blog/' . $otherSize . '-thumbs.jpg'));

            // Generate Thumbnail 200x200
            Image::make($image)->resize(200,200)->save(public_path('images/blog/' . $thumbnail));*/
        }

        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Subscriber View
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $model = $this->repository->findOrThrowException($id);

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $model,
            'repository'    => $this->repository
        ]);
    }

    /**
     * Subscriber Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Subscriber Update
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $status = $this->repository->destroy($id);

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->deleteSuccessMessage);
    }

  	/**
     * Get Table Data
     *
     * @return json|mixed
     */
    public function getTableData()
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name', 'sort'])
            ->escapeColumns(['company_name', 'sort'])
            ->escapeColumns(['categoryname', 'sort'])
            ->escapeColumns(['mobile', 'sort'])
            ->escapeColumns(['email_id', 'sort'])
            ->escapeColumns(['total_mails'])
            ->escapeColumns(['total_fail'])
            ->escapeColumns(['total_read'])
            ->escapeColumns(['username', 'sort'])
            ->addColumn('actions', function ($model) {
                return $model->admin_action_buttons;
            })
		    ->make(true);
    }
}
