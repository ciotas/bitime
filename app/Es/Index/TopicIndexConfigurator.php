<?php

namespace App\Es\Index;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class TopicIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'topics_index';
    /**
     * @var array
     */
    protected $settings = [
        'analysis' => [
            'analyzer' => 'ik_max_word',
            'search_analyzer' => 'ik_max_word'
        ]
    ];
}
