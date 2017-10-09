<?php
namespace App\Http\Requests\API\V1;

use App\Exceptions\APIErrorException;
use App\Http\Requests\BaseRequest;

class Request extends BaseRequest
{
    /**
     * Get the failed validation response for the request.
     *
     * @param array $errors
     *
     * @return APIErrorException
     *
     * @throws APIErrorException
     */
    public function response(array $errors)
    {
        $transformed = [];

        foreach ($errors as $field => $message) {
            $transformed[] = [
                'name'    => $field,
                'message' => $message[0],
            ];
        }
        throw new APIErrorException('wrongParameter', 'Wrong Parameters', ['invalidParams' => $transformed]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
