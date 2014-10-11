<?php

class HomeController extends HackController
{

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
    function __construct(\Hack\Repositories\Sas\SasInterface $sas)
    {

        $this->sas = $sas;
    }

    public function index()
    {

        $limit = 10;
        $page  = $this->input('get', [ 'page', '1' ]);


        $query = json_decode(json_encode($this->search->search([
            'index' => 'sas',
            'body' => [
                'query' => [
                    "multi_match" => [
                        "query" =>    $this->input('get', [ 'search', '*']),
                        "type"  =>       "most_fields",
                        "fields" => [ "_all" ]
                    ]
                ],

                'size' => $limit,
                'from' => $limit * ($page - 1),
            ]
        ])));

        dd($query);
    }

    public function indexOld()
    {

        if (Input::has('search')) {

            $data = $this->sas->make([])
                ->where('country', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('city', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('date', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('cost', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('notes', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('weapons', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('motive', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('target_type', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('attack_type', 'LIKE', '%' . Input::get('search') . '%')
                ->orWhere('date', 'LIKE', '%' . Input::get('search') . '%')
                ->paginate(10);

        } else {

            $data = $this->sas->make([])->paginate(1);

        }

        if (\Request::ajax()) {

            return Response::json(
                $data->toArray()
            );

        }


        $this->render('hack::index', [
            'data' => $data,

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


    public function stats()
    {

        $data = ''; //$this->sas->find($data_id);

        $this->render('hack::stats', [
            'data' => $data,

        ]);
    }

}
