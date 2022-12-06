<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::select(['name','description','type'])->paginate(10);
        return response()->json([
            'status' => 200 ,
            'data' => $categories
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
        $request->validate([
            'name' => ['required','max:50'],
            'description' =>['string','max:250'],
            'file' => ['max:5120','image','mimes:jpeg,png,jpg,svg'],
            'type' => ['required','in:1,2,3']
        ]);
        $path = '';
        if ($file = $request->file('file')) {
            $path = $file->store('public/files');
        }
        $category = category::create([
            'name' => $request->name,
            'description' => $request->description ?? '',
            'file' => $path,
            'type' => $request->type,
        ])->first(['name','description','type']);

        return response()->json([
            'status' => 200 ,
            'data' => $category
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $path = category::where('id',$id)->first(['file']);

        return response()->json([
            'status' => 200,
            'data' => $path
        ]);

    }
    public function show_category($id){
        $category = category::where('id',$id)->first(['name','description','type']);

        $url =  URL::temporarySignedRoute(
            'category.show', now()->addMinutes(10), ['id' => $id]
        );
        $category->path = $url;

        return response()->json([
            'status' => 200,
            'data' => $category
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
