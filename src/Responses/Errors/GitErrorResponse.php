<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 8:19 PM
 */

namespace Horat1us\Git\Responses\Errors;

use Horat1us\Git\Responses\BaseResponse;

/**
 * Class GitErrorResponse
 * @package Horat1us\Git\Responses
 */
class GitErrorResponse extends BaseResponse
{
    /**
     * Depends on output (see setter for details)
     *
     * @var string
     */
    protected $error;

    /**
     * @param string $output
     */
    public function setOutput(string $output)
    {
        if (!preg_match('/(?:fatal|error):\s(.*(\n(?:fatal|error)\s+.+)*)/', $output, $matches)) {
            throw new \UnexpectedValueException("Provided output does not contains git errors");
        }

        $this->error = $matches[1];
        parent::setOutput($output);
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }
}