<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Weap\Junction\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * The class name of the model for which the controller should implement CRUD actions.
     *
     * @var string
     */
    public $model = City::class;

    /**
     * The class name of Resource to be used for the show and index methods.
     *
     * @var string $resource
     */
    public $resource = CityResource::class;

    /**
     * The class name of FormRequest to be used for the store and update methods.
     *
     * @var string
     */
    public $formRequest = CityRequest::class;

    /**
     * Relations to be eager loaded with the model.
     *
     * @return array
     */
    public function relations(): array
    {
        return [
            'addresses'
        ];
    }
}
