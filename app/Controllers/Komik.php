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

        // jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . 'tidak ditemukan');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation' => \Config\Services::validation()
        ];

        return view('/komik/create', $data);
    }

    public function save()
    {
        // validasi input
        if(!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            
            session()->setFlashdata('error', $validation->listErrors());

            return redirect()->to('/komik/create')->withInput();
        }

        // $this->request->getVar();

        $slug = url_title($this->request->getVar('judul'), '-', 'true');

        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');

        return redirect()->to('/komik');
    }
}