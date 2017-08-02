<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:09 PM
 */

namespace Horat1us\Git\Tests\Validators;


use Horat1us\Git\Exceptions\InvalidGitRepository;
use Horat1us\Git\Models\GitPath;
use Horat1us\Git\Tests\BaseTest;

/**
 * Class GitPathTest
 * @package Horat1us\Git\Tests\Validators
 */
class GitPathTest extends BaseTest
{
    public function testRunningValidator()
    {
        $wrongRepositoryPath = $this->getEmptyPath();
        $this->expectException(InvalidGitRepository::class);
        new GitPath($wrongRepositoryPath);
    }

    public function testTrimming()
    {
        $repositoryPath = $this->createRepository('git_repository') . DIRECTORY_SEPARATOR;
        $path = new GitPath($repositoryPath);
        $this->assertEquals(rtrim($repositoryPath, DIRECTORY_SEPARATOR), $path->getPath());
        $this->assertEquals($path->getPath(), (string)$path);
    }
}