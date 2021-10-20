<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Jobs;

use Illuminate\Bus\Queueable;
use App\Ship\Contracts\Job as JobContract;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\{SerializesModels, InteractsWithQueue};

abstract class Job implements ShouldQueue, JobContract
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;
    public bool $deleteWhenMissingModels = true;

    public function __construct()
    {
        $this->onQueue(self::QUEUE_NAME);
    }
}
