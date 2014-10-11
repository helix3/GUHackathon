<?php

class InfoController extends HackController
{

    protected $guzzle;
    private $sas;

    protected $layout = 'hack::layouts.file';


    /**
     * @param \Hack\Repositories\Sas\SasInterface $sas
     */
    function __construct(\Hack\Repositories\Sas\SasInterface $sas)
    {

        $this->sas = $sas;

        $this->guzzle = new \GuzzleHttp\Client();
    }

    public function index($data_id)
    {



        $data = $this->sas->find($data_id);

        $wiki = $this->guzzle->get('http://wikipedia.org/w/api.php?action=query&prop=info&inprop=url&list=search&format=json&srsearch=Roy%20Dowling&srnamespace=0&srwhat=nearmatch&srprop=size%7Cwordcount%7Ctimestamp%7Cscore%7Csnippet%7Ctitlesnippet%7Credirecttitle%7Credirectsnippet%7Csectiontitle%7Csectionsnippet%7Chasrelated&srlimit=10&srinterwiki=&srbackend=LuceneSearch&iwurl=&converttitles=&generator=search&gsrsearch='.str_replace($data->attack_type, ' ', '/').' '. $data->group_name .' '. $data->city . '&gsrlimit=5');


        $bing = $this->guzzle->get('https://api.datamarket.azure.com/Bing/Search/v1/Image?Query=%27'.$data->attack_type.' '. $data->group_name .' '. $data->city . '%27&Latitude='.$data->lat.'&Longitude='.$data->long.'&$format=JSON&$top=50',['auth' => ['46MytduVZj7U1imkuw0+OnIM/bzSk4J63yakAPKeTCg', '46MytduVZj7U1imkuw0+OnIM/bzSk4J63yakAPKeTCg']]);


        $this->render('hack::info', [
            'data' => $data,
            'wiki' => $wiki->json()['query']['pages'],
            'bing' => $bing->json()['d']['results']

        ]);
    }




}
