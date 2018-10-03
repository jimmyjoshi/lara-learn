<?php namespace App\Repositories\Subscriber;

use App\Models\Category\Category;
use App\Models\Subscriber\Subscriber;
use App\Models\Access\User\User;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\Emailer\Emailer;
use DB;

class EloquentSubscriberRepository extends DbRepository
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
	public $moduleTitle = 'Subscriber';

	/**
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'name' 			=> 'Subscriber Name',
		'company_name' 	=> 'Comapny Name',
		'categoryname' 	=> 'Category',
		'mobile' 		=> 'Mobile',
        'email_id'      => 'Email Id',
        'total_mail_send'      => 'Total Sent',
        'total_success_send'      => 'Success',
        'total_fail_send'       => 'Failure',
        'total_read'      => 'Total Read',
        'username' 		=> 'Created By',
		'actions' 		=> 'Actions'
	];

	/**
	 * Table Columns
	 *
	 * @var array
	 */
	public $tableColumns = [
		'name' =>	[
			'data' 			=> 'name',
			'name' 			=> 'name',
			'searchable' 	=> true,
			'sortable'		=> true
		],
		'company_name' =>	[
			'data' 			=> 'company_name',
			'name' 			=> 'company_name',
			'searchable' 	=> true,
			'sortable'		=> true
		],
		'categoryname' => [
			'data' 			=> 'categoryname',
			'name' 			=> 'categoryname',
			'searchable' 	=> true,
			'sortable'		=> true
		],
		'mobile' =>	[
			'data' 			=> 'mobile',
			'name' 			=> 'mobile',
			'searchable' 	=> true,
			'sortable'		=> true
		],
		'email_id' =>	[
			'data' 			=> 'email_id',
			'name' 			=> 'email_id',
			'searchable' 	=> true,
			'sortable'		=> true
		],
        'total_mail_send' =>   [
            'data'          => 'total_mail_send',
            'name'          => 'total_mail_send',
            'searchable'    => false,
            'sortable'      => false
        ],
        'total_success_send' =>   [
            'data'          => 'total_success_send',
            'name'          => 'total_success_send',
            'searchable'    => false,
            'sortable'      => false
        ],
        'total_fail_send' =>   [
            'data'          => 'total_fail_send',
            'name'          => 'total_fail_send',
            'searchable'    => false,
            'sortable'      => false
        ],
        'total_read' =>   [
            'data'          => 'total_read',
            'name'          => 'total_read',
            'searchable'    => false,
            'sortable'      => false
        ],
		'username' => [
			'data' 			=> 'username',
			'name' 			=> 'username',
			'searchable' 	=> true,
			'sortable'		=> true
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
		'listRoute' 	=> 'subscriber.index',
        'createRoute'   => 'subscriber.create',
		'uploadSaveRoute' 	=> 'subscriber.upload-store',
		'storeRoute' 	=> 'subscriber.store',
		'editRoute' 	=> 'subscriber.edit',
		'updateRoute' 	=> 'subscriber.update',
		'deleteRoute' 	=> 'subscriber.destroy',
		'dataRoute' 	=> 'subscriber.get-list-data'
	];

	/**
	 * Module Views
	 *
	 * @var array
	 */
	public $moduleViews = [
        'listView'      => 'subscriber.index',
		'uploadView' 	=> 'subscriber.upload',
		'createView' 	=> 'subscriber.create',
		'editView' 		=> 'subscriber.edit',
		'deleteView' 	=> 'subscriber.destroy',
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 			= new Subscriber;
        $this->userModel        = new User;
		$this->emailerModel     = new Emailer;
		$this->categoryModel 	= new Category;
	}

	/**
	 * Create Subscriber
	 *
	 * @param array $input
	 * @return mixed
	 */
	public function create($input)
	{
		$input = $this->prepareInputData($input, true);
		$model = $this->model->create($input);

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
			$this->model->getTable().'.name',
			$this->model->getTable().'.company_name',
			$this->model->getTable().'.mobile',
			$this->model->getTable().'.email_id',
			$this->categoryModel->getTable().'.name as categoryname',
			$this->userModel->getTable().'.name as username',

		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->select('data_subscribers.*',
            'data_categories.name as categoryname',
            'users.name as username',
                DB::raw("(SELECT COUNT(id) from data_mailers where data_mailers.subscriber_id = data_subscribers.id ) as total_mail_send"),
                DB::raw("(SELECT COUNT(id) from data_mailers where send_status = 1 AND data_mailers.subscriber_id = data_subscribers.id ) as total_success_send"),
                DB::raw("(SELECT COUNT(id) from data_mailers where is_fail = 1 AND data_mailers.subscriber_id = data_subscribers.id ) as total_fail_send"),
                DB::raw("(SELECT COUNT(id) from data_mailers_log where is_read = 1 AND data_mailers_log.subscriber_id = data_subscribers.id ) as total_read")
            )
			->leftjoin($this->userModel->getTable(), $this->userModel->getTable().'.id', '=', $this->model->getTable().'.user_id')
			->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.id', '=', $this->model->getTable().'.category_id')
            ->skip(0)
            ->take(10)
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
}