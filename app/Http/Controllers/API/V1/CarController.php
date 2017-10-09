<?php
namespace App\Http\Controllers\API\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\CarRequest;
use App\Http\Responses\API\V1\Car;
use App\Repositories\CarRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Services\APIUserServiceInterface;
use App\Services\FileUploadServiceInterface;

class CarController extends Controller
{
    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\CarRepositoryInterface $carRepository */
    protected $carRepository;

    /** @var \App\Services\FileUploadServiceInterface $fileUploadService */
    protected $fileUploadService;

    /** @var ImageRepositoryInterface $imageRepository */
    protected $imageRepository;

    public function __construct(
        APIUserServiceInterface $userService,
        CarRepositoryInterface $carRepository,
        FileUploadServiceInterface $fileUploadService,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->userService       = $userService;
        $this->carRepository     = $carRepository;
        $this->fileUploadService = $fileUploadService;
        $this->imageRepository   = $imageRepository;
    }

    public function postCar(CarRequest $request)
    {
        $user = $this->userService->getUser();
        if (!$request->hasFile('car_image')) {
            throw new APIErrorException('wrongParameter', 'No Image', []);
        }

        $car = $this->carRepository->findByUserId($user->id);
        if (empty($car)) {
            $car = $this->carRepository->create(['user_id' => $user->id]);
        }

        $file      = $request->file('car_image');
        $mediaType = $file->getClientMimeType();
        $path      = $file->getPathname();
        $image     = $this->fileUploadService->upload('car-image', $path, $mediaType, [
            'entityType' => 'car',
            'entityId'   => $car->id,
            'title'      => $request->input('name', ''),
        ]);

        if (empty($image)) {
            $this->carRepository->delete($car);
            throw new APIErrorException('unknown', 'upload failed', []);
        }

        if (!empty($car->image)) {
            $this->fileUploadService->delete($car->image);
            $this->imageRepository->delete($car->image);
        }

        $this->carRepository->update($car, ['image_id' => $image->id]);

        return Car::updateWithModel($car)->response();
    }

    public function myCar()
    {
        $user = $this->userService->getUser();
        $car  = $this->carRepository->findByUserId($user->id);
        if (empty($car)) {
            throw new APIErrorException('notFound', 'Car Not found', []);
        }

        return Car::updateWithModel($car)->response();
    }
}
