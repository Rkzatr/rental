<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\UserModel as DataModel;
use Illuminate\Support\Carbon;

class Profil extends BaseApi
{
    protected $modelName = DataModel::class;

    public function save()
    {
        $users = auth()->getProvider();

        $user = $users->findById(auth()->id());
        $user->fill($this->request->getPost());
        $users->save($user);


        return $this->respond([
            "data" => $user,
            "messages" => [
                "success" => "Profil berhasil disimpan",
            ]
        ]);
    }
}
