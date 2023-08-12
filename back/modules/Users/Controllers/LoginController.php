<?php

declare(strict_types=1);

namespace Modules\Users\Controllers;

use App\Http\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Users\Requests\LoginRequest;

class LoginController extends Controller
{
    private const CREDENTIALS = ['email', 'password'];

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        // Check
        if (!$token = Auth::attempt(self::CREDENTIALS)) {
            return $this->response(['errors' => ['login' => [__('auth.failed')]]], 423);
        }

        $data = [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
        $user = Auth::user()->toArray();
        $data = array_merge($data, $user);

        return $this->response($data);
    }
}
