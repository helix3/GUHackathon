<?php

return array(

    'host' => 'http://localhost:9200',

    'settings'    => [
        'connectionClass'       => '\Elasticsearch\Connections\GuzzleConnection',
        'connectionFactoryClass'=> '\Elasticsearch\Connections\ConnectionFactory',
        'connectionPoolClass'   => '\Elasticsearch\ConnectionPool\StaticNoPingConnectionPool',
        'selectorClass'         => '\Elasticsearch\ConnectionPool\Selectors\RoundRobinSelector',
        'serializerClass'       => '\Elasticsearch\Serializers\SmartSerializer',
        'guzzleOptions'         => array(),
        'connectionPoolParams'  => array(
            'randomizeHosts' => true
        ),
        'retries'               => null,
        'sniffOnStart'          => false,
        'connectionParams'      => array(),
        'hosts' => [
          'http://localhost:9200'
        ],
//        'logging'       => true,
//        'logPath'       => '/root/elasticsearch.log',
//        'logLevel'      => Psr\Log\LogLevel::INFO
    ],

    'collections' => [
        [
            'index' => 'sas',  // index name
            'type'  => 'sas_list', // collection name
        ],

    ]

);