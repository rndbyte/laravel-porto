<?php

declare(strict_types=1);

namespace App\Ship\Contracts;

interface Job
{
    public const QUEUE_NAME = 'app.jobs';

    public function handle(): void;
    public function getQueue(): string;
}
