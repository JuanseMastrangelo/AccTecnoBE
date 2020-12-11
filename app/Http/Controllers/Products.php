<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Files;

class Products extends Controller
{

    public function getAll()
    {
        $task = Product::all();
        return $task;
    }

    public function search(String $value)
    {
        if ($value === '$'){
            $task = Product::all();
        } else {
            $task = Product::where('title', 'LIKE', "%$value%")
            ->orWhere('description', 'LIKE', "%$value%")
            ->orWhere('model', 'LIKE', "%$value%")
            ->get();
        }
        return $task;
    }

    public function add(Request $request) {
        $id = $request->get('id');
        if ($id > 0) {
            $title = $request->get('title');
            $description = $request->get('description');
            $count = $request->get('count');
            $purchaseValue = $request->get('purchaseValue');
            $saleValue = $request->get('saleValue');
            $categorieId = $request->get('categorieId');
            $subCategorieId = $request->get('subCategorieId');
            $high = $request->get('high');
            $width = $request->get('width');
            $colour = $request->get('colour');
            $warranty = $request->get('warranty');
            $model = $request->get('model');
            $weight = $request->get('weight');
            $RAM = $request->get('RAM');
            $files = $request->get('files');
            $task = Product::where('id', $id)
                    ->update([
                            'title' => $title,
                            'description' => $description,
                            'count' => $count,
                            'purchaseValue' => $purchaseValue,
                            'saleValue' => $saleValue,
                            'categorieId' => $categorieId,
                            'subCategorieId' => $subCategorieId,
                            'high' => $high,
                            'width' => $width,
                            'colour' => $colour,
                            'warranty' => $warranty,
                            'model' => $model,
                            'weight' => $weight,
                            'RAM' => $RAM,
                            'files' => $files,
                        ]);
        } else {
            $task = Product::create($request->all());
        }
        // $this->addImage($request->get('files'));
        return $task;
    }

    // Almacena archivo de base64 en el servidor fisicamente
    public function addImage($files) {
        $i = 0;
        $fileList = json_decode($files);
        foreach ($fileList as $file) {
            $fileClean = str_replace('data:image/jpeg;base64,', '', $fileList[$i]->{'path'});
            $file = base64_decode($fileClean);
            $safeName = 'prueba.png';
            $success = file_put_contents(public_path('productsImages').'/'.$safeName, $file);
            $i++;
        }
        return $i;
    }

    
    public function delete($id)
    {
        $row = Product::find($id);
        $task = $row->delete();
        return $task;
    }


    public function agotados() {
        $task = Product::where('count', '<=', '2')->get();
        return $task;
    }

    public function news() {
        $task = Product::paginate(15);
        return $task;
    }
    
    public function productById($id) {
        $task = Product::where('categorieId', '=', $id)
        ->orWhere('subCategorieId', '=', $id)
        ->get();
        return $task;
    }


}
