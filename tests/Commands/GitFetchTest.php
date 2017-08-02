<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 9:17 PM
 */

namespace Horat1us\Git\Tests\Commands;


use Horat1us\Git\Commands\GitFetch;
use Horat1us\Git\Models\GitPath;
use Horat1us\Git\Tests\BaseTest;
use Symfony\Component\Process\Process;

class GitFetchTest extends BaseTest
{
    /**
     * @var GitPath
     */
    protected $local;

    /**
     * @var GitPath
     */
    protected $remote;

    protected function setUp()
    {
        $this->local = $this->createRepository('local');
        $this->remote = $this->createRepository('remote');

        $process = new Process('git remote add origin ' . $this->remote, (string)$this->local);
        $process->mustRun();
    }

    public function testNoChanges()
    {
        $command = new GitFetch();
        $command->execute($this->local);
    }
}