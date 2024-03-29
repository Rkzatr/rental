<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Alat;
use App\Models\Rental as DataModel;
use App\Models\RentalDetail;
use CodeIgniter\Files\File;
use Illuminate\Support\Carbon;

class Rental extends BaseApi
{
    protected $modelName = DataModel::class;

    public function index()
    {
        $data = $this->modelName::with('detail');
        if ($this->request->getVar('status')) $data = $data->where('status', $this->request->getVar('status'));
        if (auth()->user()->inGroup('user')) {
            $data->where('id_customer', auth()->id());
        }
        if ($this->request->getVar('wrap')) {
            return $this->respond([$this->request->getVar('wrap') => $data->get()]);
        }
        return $this->respond($data->get());
    }

    public function beforeCreate(&$data)
    {
        $data->id_customer = auth()->id();
    }
    public function afterCreate(&$data)
    {
        $alat = $this->request->getVar("alat");
        $qty = $this->request->getVar("qty");
        foreach ($alat as $i => $v) {
            $detail = new RentalDetail();
            $detail->id_alat = $v;
            $detail->id_rental = $data->id;
            $detail->qty = $qty[$i];
            $detail->save();

            $a = Alat::find($v);

            // untuk mengurangi stok
            $a->stok -= $qty[$i];
            $a->save();
        }
    }
    function uploadBukti()
    {
        $validationRule = [
            'bukti' => [
                'label' => 'Gambar Bukti Bayar',
                'rules' => [
                    'uploaded[bukti]',
                    'is_image[bukti]',
                    'mime_in[bukti,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                ],
            ],
        ];
        if (!$this->validate($validationRule)) {
            return $this->fail($this->validator->getErrors());
        }

        $file = $this->request->getFile("bukti");
        if (!$file->isValid()) {
            return $this->fail($file->getErrorString());
        }

        if (!$file->hasMoved()) {
            $filepath = $file->store('../../public/img/bukti');
            $upload = new File($filepath);
            return $this->respond($upload->getFilename());
        }

        return $this->fail($file->getErrorString());
    }
    function cancelRental(int $id)
    {
        $data = DataModel::find($id);
        $data->status = 12;
        $data->save();
        return $this->respond([
            'message' => "Berhasil",
            'data' => $data
        ]);
    }
    function konfirmasiRental(int $id)
    {
        $data = DataModel::find($id);
        $data->status = 2;
        $data->save();


        foreach ($data->detail as $detail) {
            // untuk mengembalikan stok
            $detail->alat->stok += $detail->qty;
            $detail->alat->save();
        }

        return $this->respond([
            'message' => "Berhasil",
            'data' => $data
        ]);
    }
    function pengembalianRental(int $id)
    {
        $data = DataModel::with("detail")->find($id);
        $denda = 20000;

        if (intval(Carbon::now()->format('Ymd')) > intval($data->tgl_kembali->format('Ymd'))) {
            $data->status = 5;
            $data->denda = $denda * $data->tgl_kembali->diffInDays(Carbon::now());
        } else {
            $data->status = 10;
        }

        foreach ($data->detail as $detail) {
            // untuk mengembalikan stok
            $detail->alat->stok += $detail->qty;
            $detail->alat->save();
        }

        $data->save();
        return $this->respond([
            'message' => "Berhasil",
            'data' => $data
        ]);
    }
    function dendaRental(int $id)
    {
        $data = DataModel::find($id);
        $data->status = 10;
        $data->save();

        return $this->respond([
            'message' => "Berhasil",
            'data' => $data
        ]);
    }
}
