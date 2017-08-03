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
use Horat1us\Git\Responses\Errors\GitErrorResponse;
use Horat1us\Git\Services\CommandGeneratorService;
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
     * @var CommandGeneratorService
     */
    private $commandGenerator;

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

        $this->commandGenerator = new CommandGeneratorService($this);
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
            $output = $process->mustRun()->getOutput();
            return $this->getResponse($output);
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
        return $this->commandGenerator->generate($this->options);
    }
}