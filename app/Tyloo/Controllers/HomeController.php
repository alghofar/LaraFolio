<?php namespace Tyloo\Controllers;

class HomeController extends BaseController {

	/**
     * Create a new HomeController instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return $this->view('home.index');
	}

}