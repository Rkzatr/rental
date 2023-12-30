<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\View\View;
use Config\Services;
use Psr\Log\LoggerInterface;

abstract class BaseDashboard extends BaseController
{
    public View $view;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        service("eloquent");
        $this->view = Services::renderer();

        $this->view->setData([
            'page' => "dashboard",
        ]);

        $this->view->setData([
            'menu' => [
                'Manajemen Alat' => [
                    'id' => 'manajemen-alat',
                    'icon' => 'camera',
                    'url' => base_url('/alat'),
                ],
                'Manajemen Kategori' => [
                    'id' => 'manajemen-kategori',
                    'icon' => 'layer-group',
                    'url' => base_url('/kategori'),
                ],
                'Katalog' => [
                    'id' => 'katalog',
                    'icon' => 'th',
                    'url' => base_url('/katalog'),
                ],
                'Keranjang' => [
                    'id' => 'keranjang',
                    'icon' => 'shopping-cart',
                    'url' => base_url('/keranjang'),
                ],
                'Rental' => [
                    'id' => 'rental',
                    'icon' => 'receipt',
                    'url' => base_url('/rental'),
                ],
                'Profil' => [
                    'id' => 'profil',
                    'icon' => 'id-card',
                    'url' => base_url('/profil'),
                ],
            ],
        ]);
    }
}