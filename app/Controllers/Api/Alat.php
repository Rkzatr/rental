<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Alat as DataModel;
use Illuminate\Database\Eloquent\Model;

class Alat extends BaseApi
{
    protected $modelName = DataModel::class;

    public function index()
    {
        return $this->request->getVar('wrap') ? $this->respond([$this->request->getVar('wrap') => $this->modelName::with('kategori')->get()]) : $this->respond($this->modelName::with('kategori')->get());
    }

    public function beforeCreate(&$data)
    {
        $this->validate([
            'gambar' => [
                'uploaded[gambar]',
                'mime_in[gambar,image/png,image/jpg,image/gif]',
                'ext_in[gambar,png,jpg,gif]',
            ],
        ]);
    }

    public function afterCreate(&$data)
    {
        $file = $this->request->getFile('gambar');
        $fileName = $data->id . '.' . $file->getExtension();
        $file->move(FCPATH . 'img/alat', $fileName);
        $data->gambar = base_url('img/alat/' . $fileName);
        $data->save();
    }
    public function afterUpdate(&$data)
    {
        $file = $this->request->getFile('gambar');
        if ($file) {
            $fileName = $data->id . '.' . $file->getExtension();
            $file->move(FCPATH . 'img/alat', $fileName, true);
            $data->gambar = base_url('img/alat/' . $fileName);
            $data->save();
        }
    }
}