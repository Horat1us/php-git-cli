<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 7:26 PM
 */

namespace Horat1us\Git\Commands;

use Horat1us\Git\Models\GitPath;
use Horat1us\Git\Responses\BaseResponse;
use Horat1us\Git\Responses\GitErrorResponse;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


/**
 * Class BaseCommand
 * @package Horat1us\Git\Commands
 */
abstract class BaseCommand
{
    /**
     * @var string[]
     */
    protected $options = [];

    /**
     * BaseCommand constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        // Allow overriding default options over property
        if (!empty($options)) {
            $this->options = $options;
        }
    }

    /**
     * @return string[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Converts exception to Response (or throws if it can not handle it)
     *
     * @param ProcessFailedException $exception
     * @return BaseResponse
     */
    protected function catchException(ProcessFailedException $exception): BaseResponse
    {
        return new GitErrorResponse($exception->getProcess()->getErrorOutput());
    }

    /**
     * Converts output string to some Git Response object
     *
     * @param string $output
     * @return BaseResponse
     */
    abstract protected function getResponse(string $output): BaseResponse;


    /**
     * @param $path
     * @return BaseResponse
     */
    final public function execute(GitPath $path)
    {
        $process = new Process($this->getCommand(), (string)$path);

        try {
            return $this->getResponse($process->mustRun()->getOutput());
        } catch (ProcessFailedException $exception) {
            return $this->catchException($exception);
        }
    }

    /**
     * Generates command to be executed
     * Converts GitFormatPatch to `git format-patch`
     *
     * @return string
     */
    final public function getCommand(): string
    {
        $reflection = new \ReflectionClass($this);
        $class = $reflection->getShortName();

        $commandName = preg_replace('/^Git([A-Z][a-z]+)/', '$1', $class);
        if (!$commandName || $commandName === $class) {
            throw new \UnexpectedValueException("Can not generate command for " . $class);
        }

        preg_match_all('/([A-Z][a-z]+)/', $commandName, $matches);

        return 'git '
            . implode('-', array_map('strtolower', $matches[1]))
            . ' ' . implode(' ', $this->options);
    }
}