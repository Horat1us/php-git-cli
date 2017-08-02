<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:47 PM
 */

namespace Horat1us\Git\Tests\Commands;


use Horat1us\Git\Tests\BaseTest;
use Horat1us\Git\Tests\Fakes\Commands\GitFakeCommand;
use Horat1us\Git\Tests\Fakes\Commands\wrongGitCommand;

/**
 * Class BaseCommandTest
 * @package Horat1us\Git\Tests\Commands
 */
class BaseCommandTest extends BaseTest
{
    public function testWrongClassName()
    {
        $command = new wrongGitCommand();

        $this->expectException(\UnexpectedValueException::class);
        $command->getCommand();
    }

    public function testGeneratingCommand()
    {
        $command = new GitFakeCommand(['--some-option', '-s']);

        $this->assertEquals('git fake-command --some-option -s', $command->getCommand());
    }

    public function testExecutionError()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionCode(2);
        $path = $this->createRepository('test_repository');

        $command = new GitFakeCommand();
        $command->execute($path);
    }

    public function testSuccessfulExecution()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionCode(2);
        $path = $this->createRepository('test_repository');

        $command = new GitFakeCommand();
        $command->successful = true;
        $command->execute($path);
    }
}