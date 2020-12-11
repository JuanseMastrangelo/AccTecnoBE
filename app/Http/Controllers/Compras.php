<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComprasModel;
use App\Models\User;


use Carbon\Carbon;

class Compras extends Controller
{
    public function index()
    {
        $this->middleware('auth');
        return view('tables.buys', [
            'users' => ComprasModel::all()
        ]);
    }

    public function getAll()
    {
        $task = ComprasModel::all();
        return $task;
    }

    public function add(Request $request) {
        $task = ComprasModel::create($request->all());
        return $task;
    }

    public function update(Request $request) {
        $id = $request->get('id');
        $idProduct = $request->get('idProduct');
        $status = $request->get('status');
        $descripcion = $request->get('descripcion');
        $task = ComprasModel::where('id', $id)->update(['idProduct' => $idProduct, 'status' => $status, 'descripcion' => $descripcion]);
        return $task;
    }

    public function getOne($id) {
        $task = ComprasModel::find($id);
        return $task;
    }

    // Stats
    public function getAllThisMonth() {
        $task = ComprasModel::whereMonth(
            'created_at', '=', Carbon::now()->month
        )->get();
        return $task;
    }

    
    public function getAllLastMonth() {
        $task = ComprasModel::where(
            //'created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() DEVULVE TODO 30 dias antes
            'created_at', '=', Carbon::now()->subMonth()->month
        )->get();
        return $task;
    }


    public function generateYearChart() {
        $MonthNumber = Carbon::now()->month;
        $arrayRes = [];
        for ($month=0; $month <= 12; $month++) { 
            $salesInThisMonth = ComprasModel::whereMonth( 'created_at', '=', $month+1 )
                                -> where('status', 'success')
                                ->count();
            array_push($arrayRes, $salesInThisMonth);
        }
        return $arrayRes;
    }

}
