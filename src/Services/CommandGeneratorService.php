<?php
/**
 * Created by PhpStorm.
 * User: horat1us
 * Date: 8/2/17
 * Time: 8:35 PM
 */

namespace Horat1us\Git\Services;

use Horat1us\Git\Commands\BaseCommand;


/**
 * Class CommandGeneratorService
 * @package Horat1us\Git\Services
 */
class CommandGeneratorService
{
    /**
     * @var string
     */
    public $className;

    /**
     * CommandGeneratorService constructor.
     *
     * @param BaseCommand|null $command
     * @param string|null $className required if not command provided
     */
    public function __construct(BaseCommand $command = null, string $className = null)
    {
        if (!empty($command)) {
            $this->setCommand($command);
        } else {
            // Potentially \TypeError if not className provided (type mismatch)
            $this->setClassName($className);
        }
    }

    /**
     * @param string[] $options
     * @return string
     */
    public function generate(array $options = []): string
    {
        $commandName = preg_replace('/^Git([A-Z][a-z]+)/', '$1', $this->className);
        if (!$commandName || $commandName === $this->className) {
            throw new \UnexpectedValueException(
                sprintf("Can not generate command for %s class", $this->className),
                2
            );
        }

        preg_match_all('/([A-Z][a-z]+)/', $commandName, $matches);

        return trim(
            'git '
            . implode('-', array_map('strtolower', $matches[1]))
            . ' ' . implode(' ', $options)
        );
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $className
     * @return $this
     */
    public function setClassName(string $className)
    {
        $this->className = $className;

        return $this;
    }

    /**
     * @param BaseCommand $command
     * @return $this
     */
    public function setCommand(BaseCommand $command)
    {
        $reflection = new \ReflectionClass($command);
        $this->setClassName($reflection->getShortName());

        return $this;
    }
}