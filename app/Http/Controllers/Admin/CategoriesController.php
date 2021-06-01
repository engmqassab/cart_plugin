<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        


        $categories = Category::with('parent')
            ->withCount('products')
            ->latest()
            ->paginate();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.categories.create', [
            'categories' => Category::all(),
            'category' => new Category(),
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
        $request->validate($this->rules());
       
        $category = Category::create( $request->all() );

        return redirect()->route('admin.categories.index')
            ->with('success', "Category ($category->name) created");
            //->with('error', 'Some error message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '<>', $id)
            ->where(function($query) use($id) {
                $query->where('parent_id', '<>', $id)
                      ->orWhereNull('parent_id');
            })
            ->get();

        return view('admin.categories.edit', [
            'categories' => $categories,
            'category' => $category,
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
        $validator = $this->validator($request, $id);
        $validator->validate();

        $category = Category::findOrFail($id);

        $category->update( $request->all() );

        return redirect()->route('admin.categories.index')->with('success', "Category ($category->name) updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $category = Category::findOrFail($id);

        $categories = Category::with('parent')
            ->withCount('products')
            ->latest()
            ->paginate();
        $num = 0;
        foreach($categories as $category1){
            if($category1->id == $id && $category1->products_count > 0)
            {
                $num = 1;
            }
        }
        if($num == 1)
        {
            return redirect()->route('admin.categories.index')->with('error', "Category ($category->name) Has Cheldren");
        }
        else{
            $category->delete();

            return redirect()->route('admin.categories.index')->with('success', "Category ($category->name) deleted");
        
        }
       }

    protected function validator($request, $id = null)
    {
        $rules = $this->rules($id);
        $validator = Validator::make($request->all(), $rules, [
            'name.required' => ':attribute Required!',
            'parent_id.exists' => 'The parent not exists',
        ]);

        return $validator;
    }

    protected function rules($id = null)
    {
        return [
            'name' => ['required', 'max:255', 'min:3', "unique:categories,name,$id"],
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                "parent:$id",
                
            ],
            'description' => 'nullable|max:1000',
        ];
    }
}
