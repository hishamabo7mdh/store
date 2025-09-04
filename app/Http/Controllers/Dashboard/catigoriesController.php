<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class catigoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents=Category::all();
        return view('dashboard.categories.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(Category::rule());


        // $categories=$request->all();
        // $category=new Category($categories);
        // $category->save();
        
        // Request marge: 
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')){
            $file = $request->file('image'); // Uploadedfile Object Spath  
            // $nameFile=date('YmdHis').".".$file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $nameFile = date('Y-m-d_H-i-s') . '_' . $originalName . '.' . $extension;
            $path = $file->storeAs('uploads',$nameFile,[ 'disk' => 'public' ]);
            $data['image'] = $path;
            
        }
        
        $category=Category::create($data);

        return redirect()->route('categories.index')
        ->with('success','Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $parents=Category::all();
        // $category = Category::find($id);
        // if (!$category) {
        //     abort(404);
        // }
        try{
            $category = Category::findOrFail($id);
        }catch(Exception $e){
            return redirect()->route('categories.index')
            ->with('info','record not found!');
        }
        //SELECT * FORM categories where id <> $id AND (parent_id IS NULL OR parent_id <> $id)
        $parents = Category::where('id', '<>', $id)
        -> where(function($query)use($id){
            $query->whereNull('parent_id')->
                orWhere('parent_id','<>',$id);
        })->get();
        return view('dashboard.categories.edit',compact('parents','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        $old_image = $category->image;

        //$category->fill($request->all()exists)->save();
        $data = $request->except('image');
        if ($request->hasFile('image')){
            $file = $request->file('image'); // Uploadedfile Object Spath  
            // $nameFile=date('YmdHis').".".$file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $nameFile = date('Y-m-d_H-i-s') . '_' . $originalName . '.' . $extension;
            $path = $file->storeAs('uploads',$nameFile,[ 'disk' => 'public' ]);
            $data['image'] = $path;
            
        }



        $category->update($data);

        if($old_image && isset($data['image'])){
            Storage::disk('public')->delete($old_image);
        }



        return redirect()->route('categories.index')
        ->with('success','Category Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //this is we needs : where('id','=',$id)->delete
        $category=Category::findOrFail($id);
        $category->delete();
        if($category->image){
            Storage::disk('public')->delete($category->image);
        }
        // Category::destroy($id);
        return redirect()->route('categories.index')
        ->with('success','Category Deleted!');
    }
}
