<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ResponseContract;

use App\Models\Facility;
use App\Models\Slider;

class SliderController extends Controller
{
    public function __construct(public ResponseContract $json)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            'facility:' => 'объекты',
            // 'facility:' => (Facility::with(['owner', 'recipient'])->get()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $slide = $request->input('slide');
        $slideMaxNum = Slider::where('facility_id',$slide['facility_id'])->max('num');
        $slide['num'] = $slideMaxNum + 1;
        $slideNew = Slider::create(
            $slide
        );
        
        return $this->json->response(
            data: [
                'slide' => $slide,
                'slideNew' =>  $slideNew,
                'slideMaxNum:' => $slideMaxNum,
            ],
            message: 'Слайд создан',
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->json->response(data: [
            
            'slider' => (Facility::find($id)->sliders),
            // 'slider:' => (Facility::sliders($id)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider ): \Illuminate\Http\JsonResponse
    {
        $slideNew = $request->input('slide');
        
        $slider->update($slideNew);
        return $this->json->response(
            data: [
                'slide:' => $slider,
                'slideNew:' => $slideNew,
            ],
            message: 'Слайд обновлен',
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider): \Illuminate\Http\JsonResponse
    {
       
        try {
            $slider->delete();
        } catch (\Throwable $e) {
            return $this->json->error(message: $e->getMessage());
        }


        return $this->json->response(
            data: [
                '$slider'=> $slider,
            ],
            message: 'Слайд удален',
        );
    }
}
