<?php

declare(strict_types=1);

namespace WebApi\Requests;

use App\Http\Responses\IJSONResponse;
use WebApi\DataTransferObjects\UserDTO;

final class LoginRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string'
        ];
    }

    /**
     * @return UserDTO
     */
    public function getItem(): UserDTO
    {
        $email = $this->get('email');
        $password = $this->get('password');

        return new UserDTO(null, null, $email, $password);
    }
}