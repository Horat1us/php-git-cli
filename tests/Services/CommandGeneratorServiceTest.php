<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 8:41 PM
 */

namespace Horat1us\Git\Tests\Services;


use Horat1us\Git\Services\CommandGeneratorService;
use Horat1us\Git\Tests\BaseTest;

/**
 * Class CommandGeneratorService
 * @package Horat1us\Git\Tests\Services
 */
class CommandGeneratorServiceTest extends BaseTest
{
    public function testWrongConstructorArguments()
    {
        $this->expectException(\TypeError::class);
        new CommandGeneratorService();
    }

    public function testWrongClassGeneration()
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionCode(2);
        $service = new CommandGeneratorService(null, 'wrongGitCommandClass');
        $service->generate();
    }

    public function testSuccessfulGeneration()
    {
        $service = new CommandGeneratorService(null, 'GitPreparePatch');
        $this->assertEquals('git prepare-patch', $service->generate());
    }

    public function testUsingOptions()
    {
        $service = new CommandGeneratorService(null, 'GitFetch');
        $this->assertEquals('git fetch --all', $service->generate(['--all']));
        $this->assertEquals($service->getClassName(), 'GitFetch');
    }
}