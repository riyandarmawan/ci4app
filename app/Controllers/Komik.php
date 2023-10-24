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
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan');
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
            ],
            'penulis' => [
                'rules' => 'required|is_unique[komik.penulis]',
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
            'penerbit' => [
                'rules' => 'required|is_unique[komik.penerbit]',
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
            'sampul' => [
                'rules' => 'required|is_unique[komik.sampul]',
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            
            session()->setFlashdata('judul', $validation->getError('judul'));
            session()->setFlashdata('penulis', $validation->getError('penulis'));
            session()->setFlashdata('penerbit', $validation->getError('penerbit'));
            session()->setFlashdata('sampul', $validation->getError('penulis'));

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

        return redirect()->to(base_url() . '/komik');
    }

    public function delete($id)
    {
        $this->komikModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus!');

        return redirect()->to(base_url() . '/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('/komik/edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if($komikLama['judul'] == $this->request->getVar('judul')) {
            $ruleJudul = 'required';
        } else {
            $ruleJudul = 'required|is_unique[komik.judul]';
        }

        if($komikLama['penulis'] == $this->request->getVar('penulis')) {
            $rulePenulis = 'required';
        } else {
            $rulePenulis = 'required|is_unique[komik.penulis]';
        }

        if($komikLama['penerbit'] == $this->request->getVar('penerbit')) {
            $rulePenerbit = 'required';
        } else {
            $rulePenerbit = 'required|is_unique[komik.penerbit]';
        }

        if($komikLama['sampul'] == $this->request->getVar('sampul')) {
            $ruleSampul = 'required';
        } else {
            $ruleSampul = 'required|is_unique[komik.sampul]';
        }

        if(!$this->validate([
            'judul' => [
                'rules' => $ruleJudul,
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
            'penulis' => [
                'rules' => $rulePenulis,
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
            'penerbit' => [
                'rules' => $rulePenerbit,
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
            'sampul' => [
                'rules' => $ruleSampul,
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            
            session()->setFlashdata('judul', $validation->getError('judul'));
            session()->setFlashdata('penulis', $validation->getError('penulis'));
            session()->setFlashdata('penerbit', $validation->getError('penerbit'));
            session()->setFlashdata('sampul', $validation->getError('penulis'));

            return redirect()->to(base_url() .'/komik/edit/'. $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('judul'), '-', 'true');

        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');

        return redirect()->to(base_url() . '/komik');
    }
}