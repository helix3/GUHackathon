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

        $search_string = $data->city.' '.$data->country. ' Terrorist attack';

        $wiki = $this->guzzle->get('http://wikipedia.org/w/api.php?action=query&prop=info&inprop=url&list=search&format=json&srsearch=Roy%20Dowling&srnamespace=0&srwhat=nearmatch&srprop=size%7Cwordcount%7Ctimestamp%7Cscore%7Csnippet%7Ctitlesnippet%7Credirecttitle%7Credirectsnippet%7Csectiontitle%7Csectionsnippet%7Chasrelated&srlimit=10&srinterwiki=&srbackend=LuceneSearch&iwurl=&converttitles=&generator=search&gsrsearch=' .$search_string. '&gsrlimit=5');


        $bing = $this->guzzle->get('https://api.datamarket.azure.com/Bing/Search/v1/Image?Query=%27'.Carbon\Carbon::parse($data->date['date'])->toFormattedDateString(). ' ' .$search_string.'%27&Latitude='.$data->lat.'&Longitude='.$data->long.'&$format=JSON&$top=50',['auth' => ['46MytduVZj7U1imkuw0+OnIM/bzSk4J63yakAPKeTCg', '46MytduVZj7U1imkuw0+OnIM/bzSk4J63yakAPKeTCg']]);


        if (!array_key_exists('pages', $wiki->json()['query'])) {
            $wiki = $this->guzzle->get('http://wikipedia.org/w/api.php?action=query&prop=info&inprop=url&list=search&format=json&srsearch=Roy%20Dowling&srnamespace=0&srwhat=nearmatch&srprop=size%7Cwordcount%7Ctimestamp%7Cscore%7Csnippet%7Ctitlesnippet%7Credirecttitle%7Credirectsnippet%7Csectiontitle%7Csectionsnippet%7Chasrelated&srlimit=10&srinterwiki=&srbackend=LuceneSearch&iwurl=&converttitles=&generator=search&gsrsearch=' .$data->country. ' Terrorist attack'. '&gsrlimit=5');

        }

        $wolfram = $this->guzzle->get('http://api.wolframalpha.com/v2/query?input=notable%20events%20in%20'.Carbon\Carbon::parse($data->date['date'])->year.'&appid=TLQ89Y-WT6Y5773XK');


        $weather = $this->guzzle->get('http://api.wolframalpha.com/v2/query?input=weather%20at%20'.Carbon\Carbon::parse($data->date['date'])->toFormattedDateString().'%20in%20'.$data->city.'&appid=TLQ89Y-WT6Y5773XK');

        $this->render('hack::info', [
            'data' => $data,
            'wiki' => $wiki->json()['query']['pages'],
            'bing' => $bing->json()['d']['results'],
            'events' => $wolfram->xml()->pod[1]->subpod,
            'weather' => $weather->xml()
        ]);
    }




}
