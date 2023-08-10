<?php

declare(strict_types=1);

namespace Modules\Users\Requests;

use App\Http\ApiRequest;

class LoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'max:250', 'min:5'],
            'password' => ['required', 'string', 'max:200', 'min:3'],
        ];
    }
}
