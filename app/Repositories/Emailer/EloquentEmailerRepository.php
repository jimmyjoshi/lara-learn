<?php namespace App\Repositories\Emailer;

use App\Models\Emailer\Emailer;
use App\Models\Sms\Sms;
use App\Models\Access\User\User;
use App\Models\Subscriber\Subscriber;
use App\Models\Template\Template;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentEmailerRepository extends DbRepository
{
	/**
	 * Model
	 *
	 * @var Object
	 */
	public $model;

	/**
	 * Module Title
	 *
	 * @var string
	 */
	public $moduleTitle = 'Emailer';

	/**
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'id' 				=> 'Sr No.',
		'subscribername' 	=> 'Subscriber Name',
		'subject' 			=> 'Subject',
		'username' 			=> 'Created By',
        'read_at'           => 'Created At',
		'created_at' 		=> 'Read At',
		'actions' 			=> 'Actions'
	];

	/**
	 * Table Columns
	 *
	 * @var array
	 */
	public $tableColumns = [
		'id' =>	[
			'data' 			=> 'id',
			'name' 			=> 'id',
			'searchable' 	=> true,
			'sortable'		=> true
		],
		'subscribername' =>	[
			'data' 			=> 'subscribername',
			'name' 			=> 'subscribername',
			'searchable' 	=> true,
			'sortable'		=> true
		],
		'subject' =>	[
			'data' 			=> 'subject',
			'name' 			=> 'subject',
			'searchable' 	=> true,
			'sortable'		=> true
		],
		'username' => [
			'data' 			=> 'username',
			'name' 			=> 'username',
			'searchable' 	=> true,
			'sortable'		=> true
		],
		'created_at' => [
			'data' 			=> 'created_at',
			'name' 			=> 'created_at',
			'searchable' 	=> false,
			'sortable'		=> false
		],
        'read_at' => [
            'data'          => 'read_at',
            'name'          => 'read_at',
            'searchable'    => false,
            'sortable'      => false
        ],
		'actions' => [
			'data' 			=> 'actions',
			'name' 			=> 'actions',
			'searchable' 	=> false,
			'sortable'		=> false
		]
	];

	/**
	 * Is Admin
	 *
	 * @var boolean
	 */
	protected $isAdmin = false;

	/**
	 * Admin Route Prefix
	 *
	 * @var string
	 */
	public $adminRoutePrefix = 'admin';

	/**
	 * Client Route Prefix
	 *
	 * @var string
	 */
	public $clientRoutePrefix = 'frontend';

	/**
	 * Admin View Prefix
	 *
	 * @var string
	 */
	public $adminViewPrefix = 'backend';

	/**
	 * Client View Prefix
	 *
	 * @var string
	 */
	public $clientViewPrefix = 'frontend';

	/**
	 * Module Routes
	 *
	 * @var array
	 */
	public $moduleRoutes = [
		'listRoute' 	=> 'emailer.index',
		'createRoute' 	=> 'emailer.create',
		'storeRoute' 	=> 'emailer.store',
		'editRoute' 	=> 'emailer.edit',
		'updateRoute' 	=> 'emailer.update',
		'deleteRoute' 	=> 'emailer.destroy',
		'dataRoute' 	=> 'emailer.get-list-data'
	];

	/**
	 * Module Views
	 *
	 * @var array
	 */
	public $moduleViews = [
		'listView' 		=> 'emailer.index',
		'createView' 	=> 'emailer.create',
		'editView' 		=> 'emailer.edit',
		'deleteView' 	=> 'emailer.destroy',
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 			= new Emailer;
		$this->userModel 		= new User;
		$this->templateModel 	= new Template;
		$this->subscriberModel	= new Subscriber;
        $this->smsModel         = new Sms;
	}

	/**
	 * Create Subscriber
	 *
	 * @param array $input
	 * @param array $subscribers
	 * @return mixed
	 */
	public function create($input, $subscribers = array())
	{
        $templateData = [
			'subject' 	=> $input['subject'],
			'body' 		=> $input['body'],
			'user_id'	=> access()->user()->id
		];

		$templateModel 	= $this->templateModel->create($templateData);
		$emailerData 	= [];
        $smsData        = [];

		foreach($subscribers as $subscriber)
		{
			$checkFirstChar = substr($subscriber, 0, 1);
			if($checkFirstChar != 'j')
			{
				$emailerData[] = [
					'user_id'		=> access()->user()->id,
					'subscriber_id' => $subscriber,
					'template_id'	=> $templateModel->id,
                    'created_at'    => date('Y-m-d H:i:s'),
					'schedule_time'	=> isset($input['schedule_time']) ? $input['schedule_time'] : date('Y-m-d H:i:s')
				];

                if(isset($input['sendSmsFlag']) && $input['sendSmsFlag'] == 1)
                {
                    $smsData[] = [
                        'user_id'       => access()->user()->id,
                        'subscriber_id' => $subscriber,
                        'message'       => $input['sms'],
                        'schedule_time' => isset($input['schedule_time']) ? $input['schedule_time'] : date('Y-m-d H:i:s')
                    ];
                }
			}
		}

        if(isset($input['sendSmsFlag']) && $input['sendSmsFlag'] == 1)
        {
            $this->smsModel->insert($smsData);
        }

		$model = $this->model->insert($emailerData);

		if($model)
		{
			return $model;
		}

		return false;
	}

	/**
	 * Update Subscriber
	 *
	 * @param int $id
	 * @param array $input
	 * @return bool|int|mixed
	 */
	public function update($id, $input)
	{
		$model = $this->model->find($id);

		if($model)
		{
			$input = $this->prepareInputData($input);

			return $model->update($input);
		}

		return false;
	}

	/**
	 * Destroy Subscriber
	 *
	 * @param int $id
	 * @return mixed
	 * @throws GeneralException
	 */
	public function destroy($id)
	{
		$model = $this->model->find($id);

		if($model)
		{
			return $model->delete();
		}

		return  false;
	}

	/**
     * Get All
     *
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc')
    {
    	return $this->model->all();
    }

	/**
     * Get by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id = null)
    {
    	if($id)
    	{
    		return $this->model->find($id);
    	}

        return false;
    }

    /**
     * Get Table Fields
     *
     * @return array
     */
    public function getTableFields()
    {
    	return [
			$this->model->getTable().'.id as id',
			$this->model->getTable().'.send_status',
			$this->model->getTable().'.schedule_time',
			$this->model->getTable().'.send_at',
            $this->model->getTable().'.created_at',
            $this->model->getTable().'.read_at',
			$this->userModel->getTable().'.name as username',
			$this->subscriberModel->getTable().'.name as subscribername',
			$this->subscriberModel->getTable().'.company_name as subscribercompanyname',
			$this->templateModel->getTable().'.subject',
			$this->templateModel->getTable().'.body',
		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	return  $this->model->select($this->getTableFields())
    			->leftjoin($this->userModel->getTable(), $this->userModel->getTable().'.id', '=', $this->model->getTable().'.user_id')
    			->leftjoin($this->subscriberModel->getTable(), $this->subscriberModel->getTable().'.id', '=', $this->model->getTable().'.subscriber_id')
    			->leftjoin($this->templateModel->getTable(), $this->templateModel->getTable().'.id', '=', $this->model->getTable().'.template_id')
    			->get();
    }

    /**
     * Set Admin
     *
     * @param boolean $isAdmin [description]
     */
    public function setAdmin($isAdmin = false)
    {
    	$this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Prepare Input Data
     *
     * @param array $input
     * @param bool $isCreate
     * @return array
     */
    public function prepareInputData($input = array(), $isCreate = false)
    {
    	if($isCreate)
    	{
    		$input = array_merge($input, ['user_id' => access()->user()->id]);
    	}

    	return $input;
    }

    /**
     * Get Table Headers
     *
     * @return string
     */
    public function getTableHeaders()
    {
    	if($this->isAdmin)
    	{
    		return json_encode($this->setTableStructure($this->tableHeaders));
    	}

    	$clientHeaders = $this->tableHeaders;

    	unset($clientHeaders['username']);

    	return json_encode($this->setTableStructure($clientHeaders));
    }

	/**
     * Get Table Columns
     *
     * @return string
     */
    public function getTableColumns()
    {
    	if($this->isAdmin)
    	{
    		return json_encode($this->setTableStructure($this->tableColumns));
    	}

    	$clientColumns = $this->tableColumns;

    	unset($clientColumns['username']);

    	return json_encode($this->setTableStructure($clientColumns));
    }

    /**
     * Get Subscriber Categories
     *
     * @return array
     */
    public function getSubscriberCategories()
    {
    	$userId 	= access()->user()->id;
    	$categories = $this->categoryModel->select(['id', 'name'])->where(['user_id' => $userId, 'status' => 1 ])->get();
    	$result 	= [];

    	foreach($categories as $category)
    	{
			$result[$category->id] = $category->name;
    	}

    	return $result;
    }

    /**
     * ReadEmail
     *
     * @param string $id
     * @return bool
     */
    public function readEmail($id)
    {
        $model = $this->model->find(hasher()->decode($id));

        $model->read_at     = date('Y-m-d H:i:s');
        $model->read_status = 1;

        return $model->save();
    }
}