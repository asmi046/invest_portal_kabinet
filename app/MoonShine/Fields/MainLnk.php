<?php

declare(strict_types=1);

namespace App\MoonShine\Fields;

use Closure;
use MoonShine\UI\Fields\Field;

class MainLnk extends Field
{
    protected string $view = 'admin.fields.main-lnk';

    protected function reformatFilledValue(mixed $data): mixed
    {
        return parent::reformatFilledValue($data);
    }

    protected function prepareFill(array $raw = [], mixed $casted = null): mixed
    {
        return parent::prepareFill($raw, $casted);
    }

    protected function resolveValue(): mixed
    {
        return $this->toValue();
    }

    protected function resolvePreview(): string
    {
        return $this->toFormattedValue();
    }

    protected function resolveOnApply(): ?Closure
    {
        return function ($item) {
            return $item;
        };
    }
}
