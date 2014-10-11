<?php

class HomeController extends HackController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	/**
	 * sas
	 *
	 * @var \Hack\Repositories\Sas\SasInterface
	 */
	private $sas;

	/**
	 * @param \Hack\Repositories\Sas\SasInterface $sas
     */
	function __construct(\Hack\Repositories\Sas\SasInterface $sas) {

		$this->sas = $sas;
	}

	public function index()
	{
		if (\Illuminate\Support\Facades\Input::has('search')) {

		}

		$this->render('hack::index', [
			'data' => '',

		]);
	}

	/**
	 * Redirect from FORM filter to URL
	 *
	 * @return mixed
	 */
	public function filter()
	{
		// Strip out previous input from previous url.
		preg_match("/.*?((?:\\/[\\w\\.\\-]+)+)/is", URL::previous(), $url);

		return Redirect::to($url[0] . '?' . http_build_query(Input::except('_token')));
	}




}
