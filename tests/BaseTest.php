<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 6:36 PM
 */

namespace Horat1us\Git\Tests;

use Horat1us\Git\Models\GitPath;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

/**
 * Class BaseTest
 * @package Horat1us\Git\Tests
 */
abstract class BaseTest extends TestCase
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * BaseTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->filesystem = new Filesystem();
    }

    /**
     * @param string $path
     * @param bool $mayExists
     * @throws \UnexpectedValueException
     * @return string
     */
    protected function createFolder(string $path, bool $mayExists = true): string
    {
        $path = __DIR__ . '/data/' . $path;

        if ($this->filesystem->exists($path)) {
            if ($mayExists) {
                $this->filesystem->remove($path);
            }
        }

        $this->filesystem->mkdir($path);

        return $path;
    }

    /**
     * @param string $name
     * @param bool $mayExists
     * @return GitPath
     */
    protected function createRepository(string $name = 'git_repository', bool $mayExists = true) :GitPath
    {
        $path = $this->createFolder($name, $mayExists);

        $command = new Process('git init', $path);
        $command->mustRun();

        return new GitPath($path);
    }

    /**
     * @param string $name
     * @param string $content
     * @param bool $mayExists
     * @param bool $append
     * @return string
     */
    protected function createFile(string $name, string $content, bool $mayExists = true, bool $append = false): string
    {
        $path = __DIR__ . '/data/' . $name;

        if ($this->filesystem->exists($path)) {
            if (!$mayExists) {
                throw new \UnexpectedValueException("Cannot create file $name. File already exists.");
            }
            if (!$append) {
                $this->filesystem->remove($path);
            }
        }

        $this->filesystem->appendToFile($path, $content);
        return $path;
    }

    /**
     * @param callable|null $random
     * @return string
     */
    protected function getEmptyPath(callable $random = null): string
    {
        $random = $random ?? 'mt_rand';

        do {
            $path = __DIR__ . '/data/' . $random();
        } while ($this->filesystem->exists($path));

        return $path;
    }
}