<?php namespace App\Repositories\MyDemo;

/**
 * Class EloquentMyDemoRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\MyDemo\MyDemo;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentMyDemoRepository extends DbRepository
{
    /**
     * MyDemo Model
     *
     * @var Object
     */
    public $model;

    /**
     * MyDemo Title
     *
     * @var string
     */
    public $moduleTitle = 'MyDemo';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'        => 'Id',
'name'        => 'Name',
'age'        => 'Age',
'address'        => 'Address',
"actions"         => "Actions"
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
		'name' =>   [
                'data'          => 'name',
                'name'          => 'name',
                'searchable'    => true,
                'sortable'      => true
            ],
		'age' =>   [
                'data'          => 'age',
                'name'          => 'age',
                'searchable'    => true,
                'sortable'      => true
            ],
		'address' =>   [
                'data'          => 'address',
                'name'          => 'address',
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
        'listRoute'     => 'mydemo.index',
        'createRoute'   => 'mydemo.create',
        'storeRoute'    => 'mydemo.store',
        'editRoute'     => 'mydemo.edit',
        'updateRoute'   => 'mydemo.update',
        'deleteRoute'   => 'mydemo.destroy',
        'dataRoute'     => 'mydemo.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'mydemo.index',
        'createView'    => 'mydemo.create',
        'editView'      => 'mydemo.edit',
        'deleteView'    => 'mydemo.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new MyDemo;
    }

    /**
     * Create MyDemo
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
     * Update MyDemo
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
     * Destroy MyDemo
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