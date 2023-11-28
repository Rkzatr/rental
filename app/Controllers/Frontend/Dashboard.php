<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseDashboard;
use App\Models\Kategori;

class Dashboard extends BaseDashboard
{
    public function index()
    {
        return $this->view->render('Dashboard/index');
    }
    public function alat()
    {
        $this->view->setData([
            'page' => 'manajemen-alat'
        ]);
        return $this->view->render('Dashboard/alat');
    }

    public function kategori()
    {
        $this->view->setData([
            'page' => 'manajemen-kategori',
            'items' => Kategori::all()
        ]);
        return $this->view->render('Dashboard/kategori');
    }
    public function kategoriForm($id = null)
    {
        $this->view->setData([
            'page' => 'manajemen-kategori',
            'item' => Kategori::find($id)
        ]);
        return $this->view->render('Dashboard/kategori-tambah');
    }
}
