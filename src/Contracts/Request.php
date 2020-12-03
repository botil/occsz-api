<?php
/**
 * Copyright (c) 2020.
 * All rights reserved.
 * Written by Molnár Attila
 */

namespace Occsz\OccszApi\Contracts;

interface Request
{

    /**
     * GET
     * @param $uri
     * @param array $data
     * @return mixed
     */
    public function get($uri, $data = []);

    /**
     * POST
     * @param $uri
     * @param array $data
     * @return mixed
     */
    public function post($uri, $data = []);

}