<?php

declare(strict_types=1);

namespace Modules\Users\Requests;

use App\Http\ApiRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return Auth::guest();
    }

    /**
     * The validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'email' => ['required_if:username', 'string', 'max:250', 'min:5', 'exists:users,email'],
            'username' => ['required_if:email', 'string', 'max:200', 'min:3', 'exists:users,username'],
            'password' => ['required', 'string', 'max:200', 'min:3'],
        ];
    }
}
