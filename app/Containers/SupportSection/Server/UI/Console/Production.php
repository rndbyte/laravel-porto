<?php

declare(strict_types=1);

namespace App\Containers\SupportSection\Server\UI\Console;

use Exception;
use App\Ship\Abstracts\Console\Command;

class Production extends Command
{
    protected $signature = 'app:deploy-prod';
    protected $description = 'Обновление файлов проекта на production-сервере';

    public function handle(): void
    {
        $rootDirectory = base_path();
        $this->info('Deploy на production-сервер');
        $this->newLine(1);
        try {
            $this->comment('Установка прав для пользователя ubuntu');
            echo shell_exec("sudo chown -R ubuntu:ubuntu {$rootDirectory}");
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            exit(0);
        }

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
                echo shell_exec("/usr/bin/php composer.phar update -v");
            } catch (Exception $exception) {
                $this->error($exception->getMessage());
            }
        }
        try {
            $this->comment('Установка прав для пользователя www-data');
            echo shell_exec("sudo chown -R www-data:www-data {$rootDirectory}");
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            exit(0);
        }
        try {
            $this->call('cache:clear');
            $this->call('config:clear');
        } catch (Exception $exception) {
        }
        $this->info('Операция завершена');
    }
}
