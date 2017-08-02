<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 3:42 PM
 */

namespace Horat1us\Git\Validators;
use Horat1us\Git\Exceptions\ValidationException;


/**
 * Interface ValidatorInterface
 * @package Horat1us\Deploy\Validators
 */
interface ValidatorInterface
{
    /**
     * @throws ValidationException
     * @return void
     */
    public function validate();
}