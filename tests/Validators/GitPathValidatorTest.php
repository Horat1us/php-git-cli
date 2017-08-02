<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 6:48 PM
 */

namespace Horat1us\Git\Tests\Validators;


use Horat1us\Git\Exceptions\InvalidGitRepository;
use Horat1us\Git\Tests\BaseTest;
use Horat1us\Git\Validators\GitPathValidator;

/**
 * Class GitPathValidatorTest
 * @package Horat1us\Git\Tests\Validators
 */
class GitPathValidatorTest extends BaseTest
{

    public function testGitRepository()
    {
        $path = $this->createRepository('git_repository');
        $validator = new GitPathValidator((string)$path);
        $validator->validate();
        $this->assertDirectoryExists((string)$path);
    }

    public function testSampleFolder()
    {
        $path = $this->createFolder('sample_folder');
        $validator = new GitPathValidator($path);
        $this->expectException(InvalidGitRepository::class);
        $validator->validate();
    }

    public function testFile()
    {
        $path = $this->createFile('some_file', '');
        $validator = new GitPathValidator($path);
        $this->expectException(InvalidGitRepository::class);
        $validator->validate();
    }

    public function testNoRepository()
    {
        $validator = new GitPathValidator($this->getEmptyPath());
        $this->expectException(InvalidGitRepository::class);
        $validator->validate();
    }
}