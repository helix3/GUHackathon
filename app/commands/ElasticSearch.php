<?php

class ElasticSearch extends \Illuminate\Console\Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'elasticsearch:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update MongoDB River for elasticsearch.';

    protected $elasticsearch;
    protected $guzzle;

    /**
     * Create a new command instance.
     **/
    public function __construct()
    {
        parent::__construct();

        $this->elasticsearch = ''; //new \Elasticsearch\Client(Config::get('elasticsearch.settings'));

        $this->guzzle = new \GuzzleHttp\Client();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        // Searches for existing imports
        $get_existing_rivers = json_decode(json_encode($this->elasticsearch->search([
            'index' => '_river',
            'body' => [
                'query' => [
                    'match' => [
                        '_id' => '_meta'
                    ]
                ]
            ]
        ])));

        // Configs
        $config = Config::get('elasticsearch.collections');
        $host = Config::get('elasticsearch.host');
        $database = Config::get('database.connections.mongodb');

        // Remove deleted collections
        foreach ($get_existing_rivers->hits->hits as $item) {

            $data = $item->_source->index;

            if (!in_array_r($item->_type, $config)) {

                $this->guzzle->delete($host . '/_river/' . $item->_type . '/');
                $this->guzzle->delete($host . '/' . $data->name . '/' . $data->type . '/');

                $this->error('Collection ' . $data->type . ' from index ' . $data->name . ' deleted!');
            }

        }

        // Add new collections
        foreach ($config as $item) {
            $put = $this->guzzle->put($host . '/_river/' . $item['type'] . '/_meta', [
                'json' => [
                    'type' => 'mongodb',
                    'mongodb' => [
                        "servers" => [
                            [
                                'host' => $database['host'],
                                'port' => $database['port'],
                            ]
                        ],
                        "credentials" => [
                            [
                                "db" => "local",
                                "user" => $database['username'],
                                "password" => $database['password'],
                            ],
                        ],
                        'db' => $database['database'],
                        'collection' => $item['type'],
                    ],
                    'index' => [
                        'name' => $item['index'],
                        'type' => $item['type'],
                    ]
                ]
            ]);

            if ($put->json()['created']) {

                $this->question('Collection ' . $item['type'] . ' from index ' . $item['index'] . ' created!');

            } else {

                $this->info('Collection ' . $item['type'] . ' from index ' . $item['index'] . ' updated!');

            }
        }
    }
}
