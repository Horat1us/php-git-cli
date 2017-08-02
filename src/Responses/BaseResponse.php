<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:27 PM
 */

namespace Horat1us\Git\Responses;


/**
 * Class BaseResponse
 * @package Horat1us\Git\Responses
 */
abstract class BaseResponse
{
    /**
     * @immutable
     * @var string
     */
    private $output;

    public function __construct(string $output)
    {
        $this->output = $output;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }
}