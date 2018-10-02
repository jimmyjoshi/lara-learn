<?php namespace App\Repositories\MailerLog;

/**
 * Class EloquentMailerLogRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\MailerLog\MailerLog;
use App\Repositories\DbRepository;
use App\Models\Subscriber\Subscriber;
use App\Exceptions\GeneralException;

class EloquentMailerLogRepository extends DbRepository
{
    /**
     * MailerLog Model
     *
     * @var Object
     */
    public $model;

    /**
     * MailerLog Title
     *
     * @var string
     */
    public $moduleTitle = 'MailerLog';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'                => 'Id',
        'subscriber'        => 'Subscriber',
        'subject'           => 'Subject',
        'body'              => 'Body',
        'created_at'        => 'Send At',
        'read_at'           => 'Read At',
        "actions"           => "Actions"
    ];

    /**
     * Table Columns
     *
     * @var array
     */
    public $tableColumns = [
        'id' =>   [
                'data'          => 'id',
                'name'          => 'id',
                'searchable'    => true,
                'sortable'      => true
            ],
		'subscriber' =>   [
                'data'          => 'subscriber',
                'name'          => 'subscriber',
                'searchable'    => true,
                'sortable'      => true
            ],
		'subject' =>   [
                'data'          => 'subject',
                'name'          => 'subject',
                'searchable'    => true,
                'sortable'      => true
            ],
		'body' =>   [
                'data'          => 'body',
                'name'          => 'body',
                'searchable'    => true,
                'sortable'      => true
            ],
		'created_at' =>   [
                'data'          => 'created_at',
                'name'          => 'created_at',
                'searchable'    => true,
                'sortable'      => true
            ],
        'read_at' =>   [
                'data'          => 'read_at',
                'name'          => 'read_at',
                'searchable'    => true,
                'sortable'      => true
            ],
		'actions' => [
            'data'          => 'actions',
            'name'          => 'actions',
            'searchable'    => false,
            'sortable'      => false
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
        'listRoute'     => 'mailerlog.index',
        'createRoute'   => 'mailerlog.create',
        'storeRoute'    => 'mailerlog.store',
        'editRoute'     => 'mailerlog.edit',
        'updateRoute'   => 'mailerlog.update',
        'deleteRoute'   => 'mailerlog.destroy',
        'dataRoute'     => 'mailerlog.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'mailerlog.index',
        'createView'    => 'mailerlog.create',
        'editView'      => 'mailerlog.edit',
        'deleteView'    => 'mailerlog.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model            = new MailerLog;
        $this->subscriberModel  = new Subscriber;
    }

    /**
     * Create MailerLog
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
     * Update MailerLog
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
     * Destroy MailerLog
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
        return $this->model->orderBy($orderBy, $sort)->get();
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
            $this->model->getTable().'.*',
            $this->subscriberModel->getTable().'.name as subscriber'
        ];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->select($this->getTableFields())
            ->leftjoin($this->subscriberModel->getTable(), $this->subscriberModel->getTable().'.id', '=', $this->model->getTable().'.subscriber_id')
            ->orderBy($this->model->getTable().'.id', 'DESC')
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
}