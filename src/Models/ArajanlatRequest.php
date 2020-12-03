<?php

namespace Occsz\OccszApi\Models;

use Occsz\OccszApi\Models\KiadmanyRequest;

class ArajanlatRequest extends KiadmanyRequest
{
    /**
     * Request constructor.
     *
     * @param $options
     */
    public function __construct($options = null)
    {
        $this->reqtip = 'arajanlat';
        $this->format = 'xml';
    }
}
