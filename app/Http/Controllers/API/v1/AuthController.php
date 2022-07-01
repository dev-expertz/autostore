<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Enums\Http\StatusCode;
use App\Helpers\StrExtended;
use App\Http\Controllers\Controller;
use App\Http\Responses\AssociativeArrayResponseDTO;
use App\Http\Responses\ErrorItemDTO;
use App\Http\Responses\ErrorResponseDTO;
use App\Http\Responses\IJSONResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use WebApi\DataTransferObjects\UserDTO;
use WebApi\Requests\LoginRequest;
use WebApi\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use WebApi\DataTransferObjects\OidcDTO;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ["except" => ["authenticate", "register", "getLoginConfiguration"]]);
    }
    /**
     * @return JsonResponse
     *
     * */
    public function authenticate(Request $request): JsonResponse
    {
        $loginRequest = new LoginRequest($request->json()->all());
        $userDTO = $loginRequest->getItem();

        if (Auth::attempt($userDTO->toJSONResponse())) {
            return $this->getLoginUser($request);
        }

        $errorItem = new ErrorItemDTO("ERROR_BAD_REQUEST_400", "The provided credentials do not match our records.", "Email or Password is Incorrect", StatusCode::ERROR_BAD_REQUEST_400);
        return $this->handleResponse(new ErrorResponseDTO($errorItem));
    }

    public function getLoginConfiguration(Request $request): array
    {
        $oidcDTO = OidcDTO::getDefault();
        return $oidcDTO->toJSONResponse();
    }

    /**
     * @return JsonResponse
     *
     * */
    public function register(RegisterRequest $request): JsonResponse
    {
        $userDTO = $request->getItem();
        
        $added = User::add($userDTO->toJSONResponse());
        if (isset($added->id)) {
            return $this->authenticate($request->toRequest());
        }

        $errorItem = new ErrorItemDTO("ERROR_BAD_REQUEST_400", "Email already Exists.", "Email or Password is Incorrect", StatusCode::ERROR_BAD_REQUEST_400);
        return $this->handleResponse(new ErrorResponseDTO($errorItem));
    }

    /**
     * @return JsonResponse
     *
     * */
    public function getLoginUser(Request $request): JsonResponse
    {
        $device_name = $request->ip();
        if(StrExtended::isEmpty($device_name))
        {
            $device_name = (string) Str::uuid();
        }
        $user = $request->user();
        $user->tokens()->delete();
        $user->api_token = $user->createToken($device_name)->plainTextToken;
        $userDTO = new UserDTO($user->id, $user->name, $user->email, $user->password, $user->api_token);
        return $this->handleResponse(new AssociativeArrayResponseDTO(StatusCode::SUCCESS_OK_200, 'user', $userDTO->toJSONResponse(true)));
    }
}