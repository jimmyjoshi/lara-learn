<?php

namespace App\Http\Controllers;

use App\Repositories\Emailer\EloquentEmailerRepository;
use Illuminate\Http\Request;

/**
 * Class GeneralController.
 */
class GeneralController extends Controller
{
    /**
     * ReadEmail
     *
     * @param string $id
     * @param  Request $request
     * @return bool
     */
    public function readEmail($id, Request $request)
    {
        $repository = new EloquentEmailerRepository;

        $repository->readEmail($id);

        return ;
    }
}
