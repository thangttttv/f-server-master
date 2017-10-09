<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\AdvertiserNotificationRepositoryInterface;

class AdvertiserNotificationRequest extends BaseRequest
{
    /** @var \App\Repositories\AdvertiserNotificationRepositoryInterface */
    protected $advertiserNotificationRepository;

    public function __construct(AdvertiserNotificationRepositoryInterface $advertiserNotificationRepository)
    {
        $this->advertiserNotificationRepository = $advertiserNotificationRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_type' => 'required',
            'type'          => 'required',
            'content'       => 'required',
            'locale'        => 'required',
            'sent_at'       => 'required',
        ];
    }

    public function messages()
    {
        return $this->advertiserNotificationRepository->messages();
    }
}
