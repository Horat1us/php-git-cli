<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/3/17
 * Time: 12:04 PM
 */

namespace Horat1us\Git\Responses\Fetch;


use Horat1us\Git\Responses\BaseResponse;

/**
 * Class GitFetchResponse
 * @package Horat1us\Git\Responses\Fetch
 */
class GitFetchResponse extends BaseResponse
{
    /**
     * @var string[]
     */
    protected $fetched = [];

    public function __construct($output)
    {
        parent::__construct($output);

        if (preg_match_all('/Fetching (.+)\n/', $output, $matches)) {
            $this->fetched = $matches[1];
        }
    }

    /**
     * @return \string[]
     */
    public function getFetched(): array
    {
        return $this->fetched;
    }
}