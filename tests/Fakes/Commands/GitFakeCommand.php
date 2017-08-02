<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:51 PM
 */

namespace Horat1us\Git\Tests\Fakes\Commands;


use Horat1us\Git\Commands\BaseCommand;

/**
 * Class GitFakeCommand
 * @package Horat1us\Git\Tests\Fakes\Commands
 */
class GitFakeCommand extends BaseCommand
{
    use FakeCommandTrait;

    /**
     * @var bool
     */
    public $successful = false;

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return ['; exit 0'];
    }
}