<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends Request
{
    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function validateResolved(): void
    {
        $validator = $this->getValidatorInstance();
        if ($validator->fails()) {
            $this->failedValidation($validator);
        }
        if ($this->passesAuthorization() === false) {
            $this->failedAuthorization();
        }
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function failedValidation(Validator $validator): void
    {
        $messages = [];
        $errors = (new ValidationException($validator))->errors();
        foreach ($errors as $field => $element) {
            foreach ($element as $message) {
                $messages[] = $message;
            }
        }
        throw new HttpResponseException(
            response()->json(
                [
                    'status'  => false,
                    'message' => $messages,
                ],
                JsonResponse::HTTP_OK
            )
        );
    }
}
