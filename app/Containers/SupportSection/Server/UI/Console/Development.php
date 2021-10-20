<?php

declare(strict_types=1);

namespace App\Containers\SupportSection\Server\UI\Console;

use Exception;
use App\Ship\Abstracts\Console\Command;

class Development extends Command
{
    protected $signature = 'app:deploy-dev';
    protected $description = 'Обновление файлов проекта на development-сервере';

    public function handle(): void
    {
        $this->info('Deploy на development-сервер');
        $this->newLine(1);
        if (is_dir(base_path('.git'))) {
            $this->comment('Обновление файлов проекта из удаленного репозитория GIT');
            $git = shell_exec("which git");
            if (!$git) {
                $this->error('git не установлен');
            } else {
                try {
                    echo shell_exec("git pull origin master");
                } catch (Exception $exception) {
                    $this->error($exception->getMessage());
                }
            }
        }
        $this->newLine(1);
        $this->comment('Установка зависимостей');
        $globalComposer = shell_exec("which composer");
        $localComposer = file_exists(base_path('composer.phar'));

        if (!$globalComposer && !$localComposer) {
            $this->error('composer не установлен');
            $this->newLine(1);
        } elseif ($globalComposer) {
            try {
                echo shell_exec("composer update -v");
            } catch (Exception $exception) {
                $this->error($exception->getMessage());
            }
        } elseif ($localComposer) {
            try {
                echo shell_exec("php -d memory_limit=-1 composer.phar update -v");
            } catch (Exception $exception) {
                $this->error($exception->getMessage());
            }
        }
        try {
            $this->call('cache:clear');
            $this->call('config:clear');
            $this->call('ide-helper:generate');
            $this->call('ide-helper:model');
        } catch (Exception $exception) {
        }
        $this->info('Операция завершена');
    }
}
