<?php

declare(strict_types=1);

namespace App\Containers\SupportSection\Server\UI\Console;

use Exception;
use Illuminate\Support\Collection;
use App\Ship\Abstracts\Console\Command;

/**
 * Class Restore
 * @package App\Containers\SupportSection\Server\UI\Console
 * Запуск производится вне докер-контейнера командой: php artisan markets:db-restore --env=env.file
 */
class Restore extends Command
{
    protected $signature = 'app:db-restore';
    protected $description = 'Скачивание с FTP и восстановление БД из архива';

    private Collection $ftp;

    public function __construct()
    {
        parent::__construct();
        $this->ftp = collect(
            [
                'host'     => env('FTP_HOST'),
                'user'     => env('FTP_USER'),
                'password' => env('FTP_PASSWORD'),
            ]
        );
    }

    public function handle(): void
    {
        $this->info($this->description);
        $this->newLine();
        $file = now()->format('ymd').'.dump';
        if (file_exists($file) === false) {
            try {
                $this->comment("Скачивание архива БД с FTP ({$file})");
                $ftpServer = ftp_connect($this->ftp->get('host'));
                if (ftp_login($ftpServer, $this->ftp->get('user'), $this->ftp->get('password'))) {
                    ftp_chdir($ftpServer, '/pub/mk');
                    ftp_pasv($ftpServer, true);
                    $totalFileSize = ftp_size($ftpServer, $file);
                    $totalFileSizeKb = (int)($totalFileSize / (1024 * 1024));
                    $db = ftp_nb_get($ftpServer, $file, $file);
                    while ($db === FTP_MOREDATA) {
                        clearstatcache(false, $file);
                        $currentFileSize = filesize($file);
                        $percent = floor($currentFileSize / $totalFileSize * 100);
                        $left = 100 - $percent;
                        $currentFileSizeKb = (int)($currentFileSize / (1024 * 1024));
                        $write = sprintf(
                            "\033[0G\033[2K[%'={$percent}s>%-{$left}s] {$currentFileSizeKb}Kb/{$totalFileSizeKb}Mb ({$percent}%%)",
                            '',
                            ''
                        );
                        fwrite(STDERR, $write);
                        $db = ftp_nb_continue($ftpServer);
                    }
                }
                ftp_close($ftpServer);
            } catch (Exception $exception) {
                $this->exception($exception->getMessage());
            }
        }
        if (file_exists($file) === false) {
            $this->exception("Файл {$file} отсутствует на диске");
        }
        try {
            $this->comment('Восстановление БД из архива');
            $pgRestore = shell_exec("which pg_restore");
            if (!$pgRestore) {
                $this->exception('pg_restore не установлен');
            }
            $command = sprintf(
                '/usr/bin/pg_restore --host=%s --port=%d --username=%s --password --dbname=%s --format=c --clean --verbose %s.dump',
                config('database.connections.pgsql.host'),
                config('database.connections.pgsql.port'),
                config('database.connections.pgsql.username'),
                config('database.connections.pgsql.database'),
                now()->format('ymd'),
            );
            echo shell_exec($command);
        } catch (Exception $exception) {
            $this->exception($exception->getMessage());
        }
        $this->delete($file);
        $this->info('Операция завершена');
    }

    private function delete(string $file): void
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }

    private function exception(string $message): void
    {
        $this->newline();
        $this->error($message);
        exit(0);
    }
}
