<?php

namespace Horat1us\Git\Responses\Fetch;

/**
 * Class GitFetchEmptyResponse
 * @package Horat1us\Git\Responses
 */
class GitFetchEmptyResponse extends GitFetchResponse
{
    /**
     * GitFetchEmptyResponse constructor.
     */
    public function __construct()
    {
        parent::__construct('');
    }
}