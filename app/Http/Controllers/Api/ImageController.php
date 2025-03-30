<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\ResponseContract;
use App\Models\Facility;
class ImageController extends Controller
{
    public function __construct(public ResponseContract $json)
    {
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            
        ]);
    }

    public function catalog(Request $request): \Illuminate\Http\JsonResponse
    {
        $catalog = $request->input('catalog');
        return $this->json->response(data: [
            'catalog2' =>  $catalog,
            'catalog' =>  Storage::disk('public')->files("$catalog")
        ]);
    }

    /**
          *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,jpg'
        ]);
        $name = $request->input('name');
        $path = $request->input('path');
        if (($request->file(key: 'image') !== null) && 
            ($request->file(key: 'image') !== '')) {
            // $image = $request->file(key: 'image')->storePublicly(path: "public/$path");
            $image = $request->file(key: 'image')->storePubliclyAs(
                path: "public/$path",
                name: "$name"
            );
            // $image = substr_replace($image, 'storage', 0, 6);
           
            //  $image =$request->file(key: 'image')->store('uploads', 'public');
        }
        return $this->json->response(
            data: [
                'image' =>  $image,
                'path' => $path
            ],
            message: 'Изображение загружено',
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $path = $request->input('path');
        $image = $request->input('image');
        $id = $request->input('idObject');
        $idtrue = false;
        if ($id){
            $facility = Facility::find($id);
            $facility['urlImg'] = '';
            $facility->update();
            $idtrue = true;
        }

        try {
            Storage::disk('public')->delete($path .'/' . $image);
        } catch (\Throwable $e) {
            return $this->json->error(message: $e->getMessage());
        }

        return $this->json->response(
            data: [
                'image'=> $image,
                'id' => $idtrue
            ],
            
    );
    }
}
