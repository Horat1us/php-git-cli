<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 8:23 PM
 */

namespace Horat1us\Git\Tests\Responses;


use Horat1us\Git\Responses\Errors\GitErrorResponse;
use Horat1us\Git\Tests\BaseTest;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

/**
 * Class GitErrorResponseTest
 * @package Horat1us\Git\Tests\Responses
 */
class GitErrorResponseTest extends BaseTest
{
    public function testGitFatal()
    {
        $repository = $this->createRepository();

        // It must fail because remote origin is not specified
        $process = new Process('git fetch origin master', $repository);
        $process->run();

        $output = $process->getErrorOutput();
        $this->assertNotEmpty($output);
        $error = new GitErrorResponse($output);
        $this->assertContains("'origin' does not appear to be a git repository", $error->getError());
    }

    public function testGitError()
    {
        $repository = $this->createRepository();

        $process = new Process('git checkout not-existent-branch', $repository);
        $process->run();

        $output = $process->getErrorOutput();
        $this->assertNotEmpty($output);
        $error = new GitErrorResponse($output);
        $this->assertContains(
            "pathspec 'not-existent-branch' did not match any file(s) known to git.",
            $error->getError()
        );
        $this->assertEquals(
            $output,
            $error->getOutput()
        );
    }

    public function testInvalidOutput()
    {
        $this->expectException(\UnexpectedValueException::class);
        new GitErrorResponse('some successful output');
    }
}