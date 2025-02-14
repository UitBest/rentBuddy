<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Weap\Junction\Http\Controllers\Controller;


class AddressController extends Controller
{
    /**
     * The class name of the model for which the controller should implement CRUD actions.
     *
     * @var string
     */
    public $model = Address::class;

    /**
     * The class name of Resource to be used for the show and index methods.
     *
     * @var string $resource
     */
    public $resource = AddressResource::class;

    /**
     * The class name of FormRequest to be used for the store and update methods.
     *
     * @var string
     */
    public $formRequest = AddressRequest::class;

    /**
     * Relations to be eager loaded with the model.
     *
     * @return array
     */
    public function relations(): array
    {
        return [
            'city'
        ];
    }
}
