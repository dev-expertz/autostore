<?php

declare(strict_types=1);

namespace WebApi\Requests;

use Illuminate\Http\Request;
use WebApi\DataTransferObjects\UserDTO;

final class RegisterRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required_with:password|same:password|min:8'
        ];
    }

    /**
     * @return UserDTO
     */
    public function getItem(): UserDTO
    {
        $name = $this->get('name');
        $email = $this->get('email');
        $password = $this->get('password');
        $confirm_password = $this->get('confirm_password');

        return new UserDTO(null, $name, $email, $password);
    }

    public function toLoginRequest(): LoginRequest
    {
        $loginRequest = new LoginRequest($this->all());
        return $loginRequest;
    }

    public function toRequest(): Request
    {
        $request = new Request($this->all());
        return $request;
    }
}