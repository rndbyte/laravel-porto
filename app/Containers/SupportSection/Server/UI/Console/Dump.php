<?php

declare(strict_types=1);

namespace App\Containers\SupportSection\Server\UI\Console;

use Exception;
use Illuminate\Support\Collection;
use App\Ship\Abstracts\Console\Command;

class Dump extends Command
{
    protected $signature = 'app:db-dump';
    protected $description = 'Создание архива БД и загрузка на FTP';

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
        $this->newLine(1);
        try {
            $this->comment('Создание архива БД');
            $pgDump = shell_exec("which pg_dump");
            if (!$pgDump) {
                $this->error('pg_dump не установлен');
                $this->newLine(1);
                exit(0);
            }
            $command = sprintf(
                '/usr/bin/pg_dump --clean --host=%s --port=%d --username=%s --dbname=%s --verbose --format=c --file=%s.dump',
                config('database.connections.pgsql.host'),
                config('database.connections.pgsql.port'),
                config('database.connections.pgsql.username'),
                config('database.connections.pgsql.database'),
                now()->format('ymd'),
            );
            echo shell_exec($command);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            exit(0);
        }
        $this->newLine(1);
        $this->info('Создание архива БД завершено');
        $this->newLine(1);
        try {
            $file = now()->format('ymd').'.dump';
            $this->comment("Загрузка архива БД на FTP ({$file})");
            $ftpServer = ftp_connect($this->ftp->get('host'));
            if (ftp_login($ftpServer, $this->ftp->get('user'), $this->ftp->get('password'))) {
                ftp_chdir($ftpServer, '/pub/mk');
                ftp_pasv($ftpServer, true);
                ftp_put($ftpServer, $file, $file);
            }
            ftp_close($ftpServer);
            if (file_exists($file)) {
                unlink($file);
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            exit(0);
        }
        $this->info('Операция завершена');
    }
}
