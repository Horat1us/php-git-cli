# PHP Git CLI wrapper
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Horat1us/php-git-cli/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Horat1us/php-git-cli/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Horat1us/php-git-cli/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Horat1us/php-git-cli/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Horat1us/php-git-cli/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Horat1us/php-git-cli/build-status/master)

This library is created for using in my deployment scripts.  
It covers commands that allows pulling/fetching from remote server   

It still under development. Stable version will be availbable later.

## Usage  
### Commands
Contract:
```php
<?php
use Horat1us\Git\Models\GitPath;
use Horat1us\Git\Responses\BaseResponse;

/** @var \Horat1us\Git\Commands\BaseCommand $command */
$command = new GitSomeCommand(['--options', '-o']);
$response = $command->execute(new GitPath('/path/to/repository'));
$true = $response instanceof BaseResponse;
```
- [BaseCommand](/src/Commands/BaseCommand.php)
- [GitFetch](/src/Commands/GitFetch) - [Usage](/tests/Commands/GitFetchTest.php)
 
### Models
- [GitPath](/src/Models/GitPath.php) - Represents string with path to Git repository [Usage](/tests/Models/GitPathTest.php)
 
### Validators
- [GitPathValidator](/src/Validators/GitPathValidator.php) - Validates data for `GitPath` [Usage](/tests/Validators/GitPathValidatorTest.php)