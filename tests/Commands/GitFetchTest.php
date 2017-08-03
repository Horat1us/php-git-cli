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
use Horat1us\Git\Responses\Fetch\GitFetchEmptyResponse;
use Horat1us\Git\Responses\Fetch\GitFetchResponse;
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
        $response = $command->execute($this->local);
        $this->assertInstanceOf(GitFetchEmptyResponse::class, $response);
    }

    public function testCommit()
    {
        file_put_contents($this->remote . '/some-changed-file', mt_rand());
        $this->filesystem->appendToFile($this->remote . '/some-changed-file', "\n" . mt_rand());

        $process = new Process("git add some-changed-file", (string)$this->remote);
        $process->mustRun();

        $process = new Process("git commit -a -m 'First commit'", (string)$this->remote);
        $process->mustRun();

        $command = new GitFetch(['--all']);
        $response = $command->execute($this->local);

        $this->assertInstanceOf(GitFetchResponse::class, $response);
        $this->assertNotInstanceOf(GitFetchEmptyResponse::class, $response);

        /** @var GitFetchResponse $response */
        $this->assertCount(1, $response->getFetched());
        $this->assertEquals('origin', $response->getFetched()[0]);
    }
}