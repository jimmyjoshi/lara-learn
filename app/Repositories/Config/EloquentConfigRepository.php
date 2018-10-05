<?php namespace App\Repositories\Config;

/**
 * Class EloquentConfigRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Config\Config;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentConfigRepository extends DbRepository
{
    /**
     * Config Model
     *
     * @var Object
     */
    public $model;

    /**
     * Config Title
     *
     * @var string
     */
    public $moduleTitle = 'Config';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'            => 'Id',
        'domain'        => 'Domain',
        'host'          => 'Host',
        'username'      => 'Username',
        'password'      => 'Password',
        'set_from'      => 'Set From',
        'set_from_name' => 'Set From Name',
        'reply_to'      => 'Reply To',
        'reply_to_name' => 'Reply To Name',
        'max_limit'     => 'Max Limit',
        "actions"       => "Actions"
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
		'domain' =>   [
                'data'          => 'domain',
                'name'          => 'domain',
                'searchable'    => true,
                'sortable'      => true
            ],
		'host' =>   [
                'data'          => 'host',
                'name'          => 'host',
                'searchable'    => true,
                'sortable'      => true
            ],
		'username' =>   [
                'data'          => 'username',
                'name'          => 'username',
                'searchable'    => true,
                'sortable'      => true
            ],
		'password' =>   [
                'data'          => 'password',
                'name'          => 'password',
                'searchable'    => true,
                'sortable'      => true
            ],
		'set_from' =>   [
                'data'          => 'set_from',
                'name'          => 'set_from',
                'searchable'    => true,
                'sortable'      => true
            ],
		'set_from_name' =>   [
                'data'          => 'set_from_name',
                'name'          => 'set_from_name',
                'searchable'    => true,
                'sortable'      => true
            ],
		'reply_to' =>   [
                'data'          => 'reply_to',
                'name'          => 'reply_to',
                'searchable'    => true,
                'sortable'      => true
            ],
		'reply_to_name' =>   [
                'data'          => 'reply_to_name',
                'name'          => 'reply_to_name',
                'searchable'    => true,
                'sortable'      => true
            ],
		'max_limit' =>   [
                'data'          => 'max_limit',
                'name'          => 'max_limit',
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
        'listRoute'     => 'config.index',
        'createRoute'   => 'config.create',
        'storeRoute'    => 'config.store',
        'editRoute'     => 'config.edit',
        'updateRoute'   => 'config.update',
        'deleteRoute'   => 'config.destroy',
        'dataRoute'     => 'config.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'config.index',
        'createView'    => 'config.create',
        'editView'      => 'config.edit',
        'deleteView'    => 'config.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Config;
    }

    /**
     * Create Config
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
     * Update Config
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
     * Destroy Config
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
            $this->model->getTable().'.*'
        ];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->select($this->getTableFields())->get();
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