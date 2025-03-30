<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ResponseContract;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function __construct(public ResponseContract $json)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $facilitys = Facility::get();
        return $this->json->response(data: [
            // 'facility:' => 'объекты!!!!',
            'facilities' => ($facilitys->sortByDesc('id')->values()->all()),
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
       
        $facility = $request->input('facility');
        
        $facilityNew = Facility::create(
            $facility
        );
        Storage::disk('public')->makeDirectory("img/objects/".$facilityNew['id']);
        return $this->json->response(
            data: [
                'facility:' => $facility,
                '$facilityNew' => $facilityNew['id'],
            // 'facility:' => (Facility::with(['owner', 'recipient'])->get()),
            ],
            message: 'Объект создан',
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $facility = Facility::find($id);
        $facility->sliders;
        return $this->json->response(data: [
            'facility' => ($facility),
            // 'slider' => ($facility->sliders)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility ): \Illuminate\Http\JsonResponse
    {
        $facilityNew = $request->input('facility');
        
        $facility->update($facilityNew);
        return $this->json->response(
            data: [
                'facility:' => $facility,
                'facilityNew:' => $facilityNew,
            ],
            message: 'Объект обновлен',
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility): \Illuminate\Http\JsonResponse
    {
        $id = $facility['id'];
        try {
            $facility->delete();
        } catch (\Throwable $e) {
            return $this->json->error(message: $e->getMessage());
        }

        try {
            Storage::disk('public')->deleteDirectory("img/objects/".$id);
        } catch (\Throwable $e) {
            return $this->json->error(message: $e->getMessage());
        }

        return $this->json->response(
            data: [],
            message: 'Объект удален',
        );
    }
}
