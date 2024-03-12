<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Api\PackageRequest;
use App\Http\Requests\BookingPackageRequest;
use App\Http\Resources\Admin\Api\PackageResource;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Package;

class PackageController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(PackageResource::collection(Package::query()->get()), null);
    }

    public function store(PackageRequest $request)
    {
        $data = $request->validated();
//        $data['features'] = json_encode($data['features']);

        $package = Package::query()->create($data);

        return $this->sendResponse(PackageResource::make($package), null,201);
    }

    public function show(Package $package)
    {
        return $this->sendResponse(PackageResource::make($package), null);
    }

    public function update(PackageRequest $request, Package $package)
    {
        $data = $request->validated();
        $package->update($data);

        return $this->sendResponse(PackageResource::make($package->refresh()), null, 200);
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return $this->sendResponse(null, trans(""));
    }

    public function bookingPackage(BookingPackageRequest $request)
    {
        $booking = Booking::query()->create($request->validated());

       return $this->sendResponse(BookingResource::make($booking),null);
    }
}
