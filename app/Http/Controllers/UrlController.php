<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response as HttpResponse;

class UrlController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = UrlResource::collection(Url::getAll());
        return view('dashboard', [
            'urls' => $urls
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check if its an API request
        if ($request->is('api/*')) {

            $validatedData = $this->validateData($request);

            if ($this->getStatusCode() == HttpResponse::HTTP_BAD_REQUEST) {
                return $validatedData; // return the error response to api API call
            } else {

                $url = Url::store($request);
                
                return response()->json([new UrlResource($url)]);
            }
        }
        
        //its normal web request
        else {

            $validated = $request->validate([
                'destination' => 'required|url',
            ]);

            $url = Url::store($request);

            return redirect()->route('dashboard');
           
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        return Redirect::to($url->destination);
    }

    protected function validateData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'destination' => 'required|url',
        ]);

        if ($validator->fails()) {

            return  $this->setStatusCode(400)
                ->respondWithError([
                    'error' => $validator->errors()
                ]);
        } else {

            return $request->validate([
                'destination' => 'required|url',
            ]);
        }
    }
}
