<?php

namespace App\Observers;

use App\Models\Analyzer;

class AnalyzerObserver
{
    public function saving(Analyzer $analyzer)
    {
        $analyzer->body = clean($analyzer->body, 'user_topic_body');
    }
}
