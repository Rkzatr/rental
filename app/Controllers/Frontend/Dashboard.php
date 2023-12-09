<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseDashboard;
use App\Models\Alat;
use App\Models\Kategori;

class Dashboard extends BaseDashboard
{
    public function index()
    {
        return $this->view->render('Dashboard/index');
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
        return $this->view->render('Dashboard/kategori-form');
    }

    public function alat()
    {
        $this->view->setData([
            'page' => 'manajemen-alat',
            'items' => Alat::all()
        ]);
        return $this->view->render('Dashboard/alat');
    }
    public function alatForm($id = null)
    {
        $this->view->setData([
            'page' => 'manajemen-alat',
            'kategori' => Kategori::all(),
            'item' => Alat::find($id),
        ]);
        return $this->view->render('Dashboard/alat-form');
    }
    public function katalog()
    {
        $this->view->setData([
            'page' => 'katalog',
        ]);
        return $this->view->render('Dashboard/katalog');
    }
    public function keranjang()
    {
        $this->view->setData([
            'page' => 'keranjang',
        ]);
        return $this->view->render('Dashboard/keranjang');
    }
    public function profil()
    {
        $this->view->setData([
            'page' => 'profil',
        ]);
        return $this->view->render('Dashboard/profil');
    }
}