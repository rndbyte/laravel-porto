<?php

namespace App\Ship\Http\Requests\API;

use App\Ship\Abstracts\Requests\ApiRequest;
use App\Ship\Contracts\PaginateRequest as PaginateRequestContract;

class PaginateRequest extends ApiRequest implements PaginateRequestContract
{
    public function rules(): array
    {
        return [
            'limit' => 'integer|min:0|required_with:offset',
            'offset' => 'integer|min:0',
        ];
    }

    public function getLimit(): ?int
    {
        $limit = $this->input('limit');
        return isset($limit) ? (int) $limit : null;
    }

    public function getOffset(): ?int
    {
        $offset = $this->input('offset');
        return isset($offset) ? (int) $offset : null;
    }
}
