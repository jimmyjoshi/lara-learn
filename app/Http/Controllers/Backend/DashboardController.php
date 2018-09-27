<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Stripe;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
      return view('backend.dashboard');
    }
}