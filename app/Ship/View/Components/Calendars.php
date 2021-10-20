<?php

declare(strict_types=1);

namespace App\Ship\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Calendars extends Component
{
    public function __construct(
        public ?string $from = 'month',
        public ?string $to = 'now',
        private string $format = 'd.m.Y'
    ) {
        $this->mutation();
    }

    private function mutation(): void
    {
        if ($this->getFrom() === 'month') {
            $this->setFrom(now()->subMonth()->format($this->format));
        }
        if ($this->getFrom() === 'year') {
            $this->setFrom(now()->subYear()->format($this->format));
        }
        if ($this->getTo() === 'now') {
            $this->setTo(now()->format($this->format));
        }
        if ($this->getTo() === 'month') {
            $this->setTo(now()->subMonth()->format($this->format));
        }
    }

    private function getFrom(): ?string
    {
        return $this->from;
    }

    private function setFrom(?string $from): self
    {
        $this->from = $from;
        return $this;
    }

    private function getTo(): ?string
    {
        return $this->to;
    }

    private function setTo(?string $to): self
    {
        $this->to = $to;
        return $this;
    }

    public function render(): View
    {
        return view('components::calendars');
    }
}
