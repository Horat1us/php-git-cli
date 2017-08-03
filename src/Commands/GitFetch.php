<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:37 PM
 */

namespace Horat1us\Git\Commands;


use Horat1us\Git\Responses\BaseResponse;
use Horat1us\Git\Responses\Fetch\GitFetchEmptyResponse;
use Horat1us\Git\Responses\Fetch\GitFetchResponse;

/**
 * Class GitFetch
 * @package Horat1us\Git\Commands
 */
class GitFetch extends BaseCommand
{
    /**
     * @param string $output
     * @return GitFetchResponse|BaseResponse
     */
    protected function getResponse(string $output): BaseResponse
    {
        if (empty($output)) {
            return new GitFetchEmptyResponse();
        }

        return new GitFetchResponse($output);
    }
}