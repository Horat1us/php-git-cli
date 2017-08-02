<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:37 PM
 */

namespace Horat1us\Git\Commands;


use Horat1us\Git\Responses\BaseResponse;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
 * Class GitFetch
 * @package Horat1us\Git\Commands
 */
class GitFetch extends BaseCommand
{
    /**
     *
     *
     * @param string $output
     * @return BaseResponse
     */
    protected function getResponse(string $output): BaseResponse
    {
        // TODO: Implement getResponse() method.
    }

    /**
     * Converts exception to Response (or throws if it can not handle it)
     *
     * @param ProcessFailedException $exception
     * @return BaseResponse
     */
    protected function catchException(ProcessFailedException $exception): BaseResponse
    {
        // TODO: Implement catchException() method.
    }
}