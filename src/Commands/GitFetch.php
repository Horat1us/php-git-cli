<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:37 PM
 */

namespace Horat1us\Git\Commands;


use Horat1us\Git\Responses\BaseResponse;

/**
 * Class GitFetch
 * @package Horat1us\Git\Commands
 */
class GitFetch extends BaseCommand
{
    /**
     * @param string $output
     * @return BaseResponse
     */
    protected function getResponse(string $output): BaseResponse
    {
        xdebug_break();
    }
}