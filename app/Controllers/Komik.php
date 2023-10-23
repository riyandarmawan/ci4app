<?php 

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        // $komik = $this->komikModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];

        // cara konek db tanpa model
        // $db = \config\Database::connect();
        // $komik = $db->query('SELECT * FROM komik');
        // foreach ($komik->getResultArray() as $row) {
        //     d($row);
        // }

        // $omikModel = new \App\Models\KomikModel();
        // $komikModel = new KomikModel();

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/detail', $data);
    }
}