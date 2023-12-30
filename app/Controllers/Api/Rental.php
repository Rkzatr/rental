<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Alat;
use App\Models\Rental as DataModel;
use App\Models\RentalDetail;

class Rental extends BaseApi
{
    protected $modelName = DataModel::class;

    public function index()
    {
        return $this->request->getVar('wrap') ? $this->respond([$this->request->getVar('wrap') => $this->modelName::with('detail')->get()]) : $this->respond($this->modelName::with('detail')->get());
    }

    public function beforeCreate(&$data)
    {
        $data->id_customer = 1;
    }
    public function afterCreate(&$data)
    {
        $alat = $this->request->getVar("alat");
        foreach ($alat as $v) {
            $detail = new RentalDetail();
            $detail->id_alat = $v;
            $detail->id_rental = $data->id;
            $detail->save();

            $a = Alat::find($v);
            $a->stok--;
            $a->save();
        }
    }
}