<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;

use Illuminate\Support\Facades\DB;

class Categories extends Controller
{

    public function index()
    {
        $this->middleware('auth');
        return view('carga.categorias', [
            'categories' => Categorie::all()
        ]);
    }

    public function getAll()
    {
        $task = Categorie::select('categories.id', 'categories.name', 'categories.idParent', 'categories.files', DB::raw('COUNT(products.id) AS count'))
                ->leftjoin('products', 'categories.id', '=', 'products.categorieId')
                ->groupBy('categories.id')
                ->get();
        return $task;
    }

    public function principal()
    {
        $task = Categorie::select('categories.id', 'categories.name', 'categories.idParent', 'categories.files', DB::raw('COUNT(products.id) AS count'))
                ->leftjoin('products', 'categories.id', '=', 'products.categorieId')
                ->groupBy('categories.id')
                ->where('idParent','')
                ->get();
        
        // $task = Product::where('categorieId', '=', $id);
        return $task;
    }

    public function subCategories($id)
    {
        $task = Categorie::where('idParent', $id)->get();
        return $task;
    }

    public function add(Request $request) {
        $id = $request->get('id');
        if ($id > 0) {
            $name = $request->get('name');
            $files = $request->get('files');
            $task = Categorie::where('id', $id)->update(['name' => $name, 'files' => $files]);
        } else {
            $task = Categorie::create($request->all());
        }
        return $task;
    }

    
    public function delete($id)
    {
        $row = Categorie::find($id);
        $task = $row->delete();
        return $task;
    }
}
