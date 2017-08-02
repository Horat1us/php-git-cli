<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:52 PM
 */

namespace Horat1us\Git\Tests\Fakes\Commands;


use Horat1us\Git\Responses\BaseResponse;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
 * Class FakeCommandTrait
 * @package Horat1us\Git\Tests\Fakes\Commands
 */
trait FakeCommandTrait
{

    /**
     * @param string $output
     * @return BaseResponse
     */
    protected function getResponse(string $output): BaseResponse
    {
        throw new \BadMethodCallException("Method getResponse is not supported.", 1);
    }

    /**
     * Converts exception to Response (or throws if it can not handle it)
     *
     * @param ProcessFailedException $exception
     * @return BaseResponse
     */
    protected function catchException(ProcessFailedException $exception): BaseResponse
    {
        throw new \BadMethodCallException("Method catchException is not supported", 2);
    }
}