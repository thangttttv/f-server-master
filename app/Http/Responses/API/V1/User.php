<?php
namespace App\Http\Responses\API\V1;

class User extends Response
{
    protected $columns = [
        'id'                 => 0,
        'firstName'          => '',
        'lastName'           => '',
        'phoneNumber'        => '',
        'email'              => '',
        'country'            => '',
        'city'               => null,
        'area'               => null,
        'profileImage'       => null,
        'dateOfBirth'        => '',
        'driverLicenceImage' => '',
        'car'                => null,
        'bankAccounts'       => [],
    ];

    protected $optionalColumns = [
    ];

    /**
     * @param \App\Models\User $user
     * @param int              $statusCode
     *
     * @return static
     */
    public static function updateWithModel($user, $statusCode = 200)
    {
        $area         = null;
        $city         = null;
        $country      = null;
        $car          = null;
        $bankAccounts = (BankAccounts::updateListAllWithModel($user->bankAccounts))->data['items'];
        if (!empty($user->country)) {
            $country = Country::updateWithModel($user->country)->toArray();
        }
        if (!empty($user->city)) {
            $city = City::updateWithModel($user->city)->toArray();
        }
        if (!empty($user->mainArea)) {
            $area = Area::updateWithModel($user->mainArea)->toArray();
        }
        if (!empty($user->car)) {
            $car = Car::updateWithModel($user->car)->toArray();
        }
        $response = new static([
            'id'                 => $user->id,
            'firstName'          => $user->first_name,
            'lastName'           => $user->last_name,
            'phoneNumber'        => $user->phone_number,
            'email'              => $user->email,
            'country'            => $country,
            'city'               => $city,
            'area'               => $area,
            'car'                => $car,
            'dateOfBirth'        => $user->date_of_birth,
            'profileImage'       => $user->getProfileImageUrl(),
            'driverLicenceImage' => $user->present()->driverLicenceImage(),
            'bankAccounts'       => $bankAccounts,
        ], $statusCode);

        return $response;
    }
}
