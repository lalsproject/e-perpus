<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role') != 'admin') {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissable" style=""><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center>Waktu Sesi Habis, Silakan Login Kembali</center></div>');
			redirect('login');
		}
	}

	private function uploader_pdf($files = false,$kdfile= false)
	{
		if ($files != false)
		{
			$files = $_FILES[$kdfile]['name'];
			if (empty($files))
			{
				return false;
			}
			else
			{
				$config = array(
					'upload_path' => './mods/assets/book/', 
					'allowed_types' => 'pdf|PDF',
					'file_name' => $kdfile.'-'.date('dmY').'-'.rand(),
				);

				// $this->load->library('image_lib', $config);
				// $this->image_lib->resize();
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload($kdfile))
				{
					return 'format not allow';
				}
				else
				{
					$gambar = $this->upload->data('file_name'); 
					$kdfile = "";
					unset($this->upload);
					return $gambar; 
				}
			}
		}
		else
		{
			return false;
		}
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		adminPage('admin/home',$data);
	}

	function kategori()
	{
		$data['title'] = 'Master Kategori';
		$data['kategori'] = $this->db->get('tbl_kategori')->result();
		adminPage('admin/kategori',$data);
	}

	function tambah_kategori()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$kategori = $this->input->post('kategori');
			$keterangan = $this->input->post('keterangan');

			$cek = $this->db->get_where('tbl_kategori','NamaKategori = "'.$kategori.'"');
			if ($cek->num_rows() > 0)
			{
				$this->session->set_flashdata('notif','<script>swal("Error","Kategori '.$kategori.' Sudah Ada ","error")</script>');
				redirect('Admin/kategori');
			}
			else
			{
				$data = array(
					'NamaKategori' => $kategori, 
					'Ket_Kategori' => $keterangan, 
				);

				$this->db->insert('tbl_kategori', $data);
				$this->session->set_flashdata('notif','<script>swal("Success","Kategori Berhasil Ditambahkan","success")</script>');
				redirect('Admin/kategori');
			}
		}
		else
		{
			http_response_code(404);
		}
	}

	function get_edit_kategori()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$idkategori = decrypt_url($this->input->post('arg'));
			$data['kat'] = $this->db->get_where('tbl_kategori', 'IdKategori = "'.$idkategori.'"')->row();
			$this->load->view('ajx/edit_kategori', $data);
		}
		else
		{
			http_response_code(404);
		}
	}

	function simpan_edit_kategori()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$idkategori = decrypt_url($this->input->post('arg'));
			$kategori = $this->input->post('kategori');
			$keterangan = $this->input->post('keterangan');

			$cek = $this->db->get_where('tbl_kategori','NamaKategori = "'.$kategori.'" AND IdKategori != "'.$idkategori.'"');
			if ($cek->num_rows() > 0)
			{
				$this->session->set_flashdata('notif','<script>swal("Error","Kategori '.$kategori.' Sudah Ada ","error")</script>');
				redirect('Admin/kategori');
			}
			else
			{
				$data = array(
					'NamaKategori' => $kategori, 
					'Ket_Kategori' => $keterangan, 
				);

				$this->db->update('tbl_kategori', $data,array('IdKategori' => $idkategori,));
				$this->session->set_flashdata('notif','<script>swal("Success","Kategori Berhasil Diedit","success")</script>');
				redirect('Admin/kategori');
			}
		}
	}

	function hapus_kategori($id = false)
	{
		if ($id != false)
		{
			$id = decrypt_url($id);
			$this->db->delete('tbl_kategori','IdKategori = "'.$id.'"');
			$this->session->set_flashdata('notif','<script>swal("Success","Kategori Berhasil Dihapus","success")</script>');
			redirect('Admin/kategori');
		}
		else
		{
			http_response_code(404);
		}
	}

	function buku()
	{
		$data['title'] = 'Master Buku';
		$data['buku'] = $this->db->get('tbv_buku')->result();
		$data['kategori'] = $this->db->get('tbl_kategori')->result();
		adminPage('admin/master_buku',$data);
	}

	function tambah_buku()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$judul = $this->input->post('judul');
			$pengarang = $this->input->post('pengarang');
			$tahun = $this->input->post('tahun');
			$kategori = decrypt_url($this->input->post('kategori'));
			$tipe = $this->input->post('tipe');
			$daftar = $this->input->post('daftar-isi');
			$denda = $this->input->post('denda');
			$jmlh = $this->input->post('jmlh');
			if ($tipe == 'E-BOOK')
			{
				$ebook = $this->uploader_pdf($_FILES['ebook'],'ebook');
				if($ebook == 'format not allow')
				{

					$this->session->set_flashdata('notif','<script>swal("Warning","File Tidak di Dukung","warning")</script>');
					redirect('Admin/buku');
				}
				else if($ebook == false)
				{
					$this->session->set_flashdata('notif','<script>swal("error","File Bermasalah","error")</script>');
					redirect('Admin/buku');
				}
			}
			else
			{
				$ebook = "-";
			}

			$data = array(
				'IdKategori' => $kategori, 
				'tipe_buku' => $tipe, 
				'judul_buku' => $judul, 
				'pengarang_buku' => $pengarang, 
				'tahun_buku' => $tahun, 
				'ebook_buku' => $ebook, 
				'daftarisi_buku' => $daftar, 
				'harga_denda' => $denda, 
				'jmlh_buku' => $jmlh, 
				'status_buku' => 'Y', 
			);

			$insert = $this->db->insert('tbl_buku', $data);
			if ($insert)
			{
				$this->session->set_flashdata('notif','<script>swal("Success","Buku Berhasil di Tambahkan","success")</script>');
				redirect('Admin/buku');
			}
			else
			{
				$this->session->set_flashdata('notif','<script>swal("error","Buku Tidak Berhasil di Tambahkan","error")</script>');
				redirect('Admin/buku');
			}
		}
	}

	function get_edit_buku()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$id = decrypt_url($this->input->post('arg'));
			$data['buku'] = $this->db->get_where('tbv_buku','IdBuku = "'.$id.'"')->row();
			$data['kategori'] = $this->db->get_where('tbl_kategori','IdKategori != "'.$data['buku']->IdKategori.'"')->result();
			$this->load->view('ajx/edit_buku', $data);
		}
	}

	function edit_buku()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$id = decrypt_url($this->input->post('arg'));
			$judul = $this->input->post('judul');
			$pengarang = $this->input->post('pengarang');
			$tahun = $this->input->post('tahun');
			$kategori = decrypt_url($this->input->post('kategori'));
			$daftar = $this->input->post('daftar-isi');
			$denda = $this->input->post('denda');
			$jmlh = $this->input->post('jmlh');
			$data = array(
				'IdKategori' => $kategori, 
				'judul_buku' => $judul, 
				'pengarang_buku' => $pengarang, 
				'tahun_buku' => $tahun,
				'daftarisi_buku' => $daftar,
				'jmlh_buku' => $jmlh, 
				'harga_denda' => $denda, 
			);

			$update = $this->db->update('tbl_buku', $data,array('IdBuku' => $id,));
			if ($update)
			{
				$this->session->set_flashdata('notif','<script>swal("Success","Buku Berhasil di Edit","success")</script>');
				redirect('Admin/buku');
			}
			else
			{
				$this->session->set_flashdata('notif','<script>swal("error","Buku Tidak Berhasil di Edit","error")</script>');
				redirect('Admin/buku');
			}
		}
	}

	function hapus_buku($id = false)
	{
		if ($id != false)
		{
			$id = decrypt_url($id);
			$this->db->delete('tbl_buku',array('IdBuku' => $id,));
			$this->session->set_flashdata('notif','<script>swal("Success","Buku Berhasil di Hapus","success")</script>');
			redirect('Admin/buku');
		}
		else
		{
			http_response_code(404);
		}
	}

	function siswa()
	{
		$data['title'] = 'Data Siswa';
		$data['siswa'] = $this->db->get_where('tbl_users','flag_admin = "N"')->result();
		$data['kategori'] = $this->db->get('tbl_kategori')->result();
		adminPage('admin/siswa',$data);
	}

	function tambah_siswa()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$nis = $this->input->post('nis');
			$nama = $this->input->post('nama');
			$tahun = $this->input->post('tahun');
			$nohp = $this->input->post('nohp');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			$ids = rand(1,9999);
			$foto = photo_uploader($_FILES['foto'],'foto');
			$id_telegram = $this->input->post('id_telegram');
			if ($foto == false or $foto == 'format not allow')
			{
				$foto = 'default.jpg';
			}
			
			$data = array(
				'IdUser' => $ids, 
				'nis_nip' => $nis, 
				'nama' => $nama, 
				'alamat' => $alamat, 
				'nohp' => $nohp, 
				'tahunmasuk' => $tahun, 
				'email' => $email, 
				'foto' => $foto, 
				'id_telegram' => $id_telegram, 
				'flag_acc' => 'Y', 
			);

			$cek = $this->db->get_where('tbl_users', 'nis_nip = "'.$nis.'" or email = "'.$email.'"');
			if ($cek->num_rows() > 0)
			{

				$this->session->set_flashdata('notif','<script>swal("Warning","NIP/NIS/E-Mail Sudah Ada","warning")</script>');
				redirect('Admin/siswa');
			}
			else
			{
				$this->db->insert('tbl_users', $data);
				$data_login = array(
					'IdUser' => $ids, 
					'username' => $email, 
					'password' => md5($nis), 
					'Role' => 'siswa', 
					'FlagAktif' => 'Y', 
				);

				$this->db->insert('tbl_login', $data_login);
				$rekom = array();
                foreach ($_POST['kategori'] as $key => $row)
                {
                    $rekom[] = array(
                        'IdUser' => $ids, 
                        'IdKategori' => decrypt_url($this->input->post('kategori')[$key]), 
                    );
                }
                $this->db->insert_batch('tbl_rekom', $rekom);
				$this->session->set_flashdata('notif','<script>swal("Success","Data Siswa Berhasil Ditambahkan","success")</script>');
				redirect('Admin/siswa');
			}
		}
		else
		{
			http_response_code(404);
		}
	}

	function get_edit_siswa()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$id = decrypt_url($this->input->post('arg'));
			$cek = $this->db->get_where('tbl_users', 'IdUser = "'.$id.'"');
			if ($cek->num_rows() > 0)
			{
				$data['siswa'] = $cek->row();
				$this->load->view('ajx/edit_siswa', $data);
			}
			else
			{
				echo "<H3><center>DATA TIDAK DI TEMUKAN</center></H3>";
			}
		}
		else
		{
			http_response_code(404);
		}
	}

	function edit_siswa()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$nis = $this->input->post('nis');
			$nama = $this->input->post('nama');
			$tahun = $this->input->post('tahun');
			$nohp = $this->input->post('nohp');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			$ids = decrypt_url($this->input->post('arg'));
			$id_telegram = $this->input->post('id_telegram');
			$data = array( 
				'nis_nip' => $nis, 
				'nama' => $nama, 
				'alamat' => $alamat, 
				'nohp' => $nohp, 
				'tahunmasuk' => $tahun,
				'id_telegram' => $id_telegram,  
				'email' => $email, 
			);

			$cek = $this->db->get_where('tbl_users', '(nis_nip = "'.$nis.'" or email = "'.$email.'") AND (IdUser != "'.$ids.'")');
			if ($cek->num_rows() > 0)
			{
				$this->session->set_flashdata('notif','<script>swal("Warning","NIP/NIS/E-Mail Sudah Ada","warning")</script>');
				redirect('Admin/siswa');
			}
			else
			{
				$this->db->update('tbl_users', $data,array('IdUser' => $ids,));
				$data_login = array(
					'username' => $email,
				);
				$this->db->update('tbl_login', $data_login,array('IdUser' => $ids,));
				$this->session->set_flashdata('notif','<script>swal("Success","Data Siswa Berhasil Diedit","success")</script>');
				redirect('Admin/siswa');
			}
		}
	}

	function access_siswa($id='',$flag = '')
	{
		if ($id != '' AND $flag != '')
		{
			$id = decrypt_url($id);
			$flag = decrypt_url($flag);
			$this->db->update('tbl_users', array('flag_acc' => $flag, ),'IdUser = "'.$id.'"');
			
			$this->session->set_flashdata('notif','<script>swal("Success","Akses Login Siswa Berhasil Diupdate","success")</script>');
			redirect('Admin/siswa');
		}
		else
		{
			http_response_code(404);
		}
	}

	function access_admin($id='',$flag = '')
	{
		if ($id != '' AND $flag != '')
		{
			$id = decrypt_url($id);
			$flag = decrypt_url($flag);
			$this->db->update('tbl_users', array('flag_acc' => $flag, ),'IdUser = "'.$id.'"');
			$this->session->set_flashdata('notif','<script>swal("Success","Akses Login Admin Berhasil Diupdate","success")</script>');
			redirect('Admin/data_admin');
		}
		else
		{
			http_response_code(404);
		}
	}

	function data_admin()
	{
		$data['title'] = 'Data Admin';
		$data['admin'] = $this->db->get_where('tbl_users','flag_admin = "Y"')->result();
		adminPage('admin/data_admin',$data);
	}

	function tambah_admin()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$nis = $this->input->post('nis');
			$nama = $this->input->post('nama');
			$tahun = $this->input->post('tahun');
			$nohp = $this->input->post('nohp');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			$ids = rand(1,999999);
			$foto = photo_uploader($_FILES['foto'],'foto');
			$id_telegram = $this->input->post('id_telegram');
			if ($foto == false or $foto == 'format not allow')
			{
				$foto = 'default.jpg';
			}
			
			$data = array(
				'IdUser' => $ids, 
				'nis_nip' => $nis, 
				'nama' => $nama, 
				'alamat' => $alamat, 
				'nohp' => $nohp, 
				'tahunmasuk' => $tahun, 
				'email' => $email, 
				'foto' => $foto, 
				'flag_acc' => 'Y', 
				'id_telegram' => $id_telegram, 
				'flag_admin' => 'Y', 
			);

			$cek = $this->db->get_where('tbl_users', 'nis_nip = "'.$nis.'" or email = "'.$email.'"');
			if ($cek->num_rows() > 0)
			{
				$this->session->set_flashdata('notif','<script>swal("Warning","NIP/NIS/E-Mail Sudah Ada","warning")</script>');
				redirect('Admin/data_admin');
			}
			else
			{
				$this->db->insert('tbl_users', $data);
				$data_login = array(
					'IdUser' => $ids, 
					'username' => $email, 
					'password' => md5($nis), 
					'Role' => 'admin', 
					'FlagAktif' => 'Y', 
				);

				$this->db->insert('tbl_login', $data_login);
				$this->session->set_flashdata('notif','<script>swal("Success","Data Admin Berhasil Ditambahkan","success")</script>');
				redirect('Admin/data_admin');
			}
		}
		else
		{
			http_response_code(404);
		}
	}

	function edit_admin()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$nis = $this->input->post('nis');
			$nama = $this->input->post('nama');
			$tahun = $this->input->post('tahun');
			$nohp = $this->input->post('nohp');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			$id_telegram = $this->input->post('id_telegram');
			$ids = decrypt_url($this->input->post('arg'));
			
			$data = array( 
				'nis_nip' => $nis, 
				'nama' => $nama, 
				'alamat' => $alamat, 
				'nohp' => $nohp, 
				'tahunmasuk' => $tahun, 
				'id_telegram' => $id_telegram, 
				'email' => $email, 
			);

			$cek = $this->db->get_where('tbl_users', '(nis_nip = "'.$nis.'" or email = "'.$email.'") AND (IdUser != "'.$ids.'")');
			if ($cek->num_rows() > 0)
			{
				$this->session->set_flashdata('notif','<script>swal("Warning","NIP/NIS/E-Mail Sudah Ada","warning")</script>');
				redirect('Admin/data_admin');
			}
			else
			{
				$this->db->update('tbl_users', $data,array('IdUser' => $ids,));
				$data_login = array(
					'username' => $email,
				);
				$this->db->update('tbl_login', $data_login,array('IdUser' => $ids,));
				$this->session->set_flashdata('notif','<script>swal("Success","Data Admin Berhasil Diedit","success")</script>');
				redirect('Admin/data_admin');
			}
		}
	}

	function data_pinjam()
	{
		$data['title'] = 'Data Peminjaman Buku';
		$data['pinjam'] = $this->db->order_by('RegDate','Desc')->get('tbv_history')->result();
		adminPage('admin/data_pinjam',$data);
	}

	function acc_pinjam($id = false)
	{
		if ($id != false)
		{
			$id = decrypt_url($id);
			$this->db->update('tbl_pinjam', array('status_pin' => 'Y'),array('id_pinjam' => $id));
			$this->session->set_flashdata('notif','<script>swal("Success","Buku Berhasil Dipinjamkan","success")</script>');
			redirect('Admin/data_pinjam');
		}
		else
		{
			http_response_code(404);
		}
	}

	function batal_pinjam()
	{
		if ($id != false)
		{
			$id = decrypt_url($id);
			$this->db->update('tbl_pinjam', array('status_pin' => 'N','status_kembali'=> 'Y'),array('id_pinjam' => $id));
			$this->session->set_flashdata('notif','<script>swal("Success","Peminjaman buku berhasil dibatalkan","success")</script>');
			redirect('Admin/data_pinjam');
		}
		else
		{
			http_response_code(404);
		}
	}

	function get_denda()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$idpinjam = decrypt_url($this->input->post('arg'));
			$data = $this->db->get_where('tbv_history', 'id_pinjam = "'.$idpinjam.'"')->row();
			echo json_encode($data);
		}
	}

	function kembali_buku($id)
	{
		if ($id != false)
		{
			$id = decrypt_url($id);
			$this->db->update('tbl_pinjam', array('status_pin' => 'Y','status_kembali'=> 'Y','tgl_kembali' => date('Y-m-d H:i:s')),array('id_pinjam' => $id));
			$this->session->set_flashdata('notif','<script>swal("Success","Buku Berhasil Dikembalikan","success")</script>');
			redirect('Admin/data_pinjam');
		}
		else
		{
			http_response_code(404);
		}
	}

	function update_password()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$user = $this->session->userdata('iduser');
			$old = md5($this->input->post('old_pass'));
			$cek = $this->db->get_where('tbl_login', 'IdUser = "'.$user.'" AND password = "'.$old.'" ');
			if ($cek->num_rows() > 0)
			{
				$new = md5($this->input->post('new_pass'));
				$update = $this->db->update('tbl_login',array('password' => $new),array('IdUser' => $user));
				if ($update)
				{
					$this->session->set_flashdata('notif', '<script>
															    setTimeout(function() {
															        swal({
															            title: "Berhasil",
															            text: "Password Berhasil Diubah \n Silakan Login Kembali",
															            type: "success"
															        }, function() {
															            window.location = "'.site_url('Login/logout').'";
															        });
															    }, 1000);
															</script>');
					redirect('Admin');
				}
			}
			else
			{
				$this->session->set_flashdata('notif', '<script>swal("Warning","Password Lama Salah","warning")</script>');
				redirect('Admin');
			}
		}
		else
		{
			http_response_code(404);
		}
	}

	function print_lap($awal='',$akhir = '')
	{
		if ($awal != '' OR $akhir != '')
		{
			$data['history'] = $this->db->get_where('tbv_history','waktupinjam_pin BETWEEN "'.$awal.'" AND "'.$akhir.'"')->result();
			$data['awal'] = $awal;
			$data['akhir'] = $akhir;
			$this->load->view('print', $data);
		}
	}
}

/* End of file Admin.php */
