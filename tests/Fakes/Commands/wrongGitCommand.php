<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:48 PM
 */

namespace Horat1us\Git\Tests\Fakes\Commands;


use Horat1us\Git\Commands\BaseCommand;

/**
 * Class wrongGitCommand
 * @package Horat1us\Git\Tests\Fakes
 *
 * This class is created to test wrong name for git command class
 */
class wrongGitCommand extends BaseCommand
{
    use FakeCommandTrait;
}