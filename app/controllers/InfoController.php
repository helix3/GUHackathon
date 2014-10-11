<?php

class InfoController extends HackController {

    private $sas;

    protected $layout = 'hack::layouts.file';


    /**
     * @param \Hack\Repositories\Sas\SasInterface $sas
     */
    function __construct(\Hack\Repositories\Sas\SasInterface $sas) {

        $this->sas = $sas;
    }

    public function index($data_id)
    {

        $data = $this->sas->find($data_id);

        $this->render('hack::file', [
            'data' => $data,

        ]);
    }


}
