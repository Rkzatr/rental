<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Kategori as ModelsKategori;
use Illuminate\Database\Eloquent\Model;

class Kategori extends BaseApi
{
    protected $modelName = ModelsKategori::class;

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
        $file->move(FCPATH . 'img/kategori', $fileName);
        $data->gambar = base_url('img/kategori/' . $fileName);
        $data->save();
    }
    public function afterUpdate(&$data)
    {
        $file = $this->request->getFile('gambar');
        if ($file) {
            $fileName = $data->id . '.' . $file->getExtension();
            $file->move(FCPATH . 'img/kategori', $fileName, true);
            $data->gambar = base_url('img/kategori/' . $fileName);
            $data->save();
        }
    }

    public function delete($id = null)
    {
        if ($data = $this->modelName::with("alat")->find($id)) {
            if ($this->modelName::find($id)->loadCount("alat")->alat_count > 0) {
                return $this->respond([
                    'messages' => [
                        'error' => 'Kategori masih memiliki alat, harap hapus semua alat pada kategori ini terlebih dahulu',
                    ],
                    'data' => $data
                ]);
            }
            $data->delete();

            return $this->respond([
                'messages' => [
                    'success' => 'Kategori berhasil dihapus',
                ],
                'data' => $data
            ]);
        }
        return $this->failNotFound('Data tidak ditemukan');
    }
}
