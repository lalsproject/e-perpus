<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role') != 'siswa') {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissable" style=""><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center>Waktu Sesi Habis, Silakan Login Kembali</center></div>');
			redirect('login');
		}
	}

	public function index()
	{
		$data['title'] = 'Dashboard Siswa';
		$data['new_book'] = $this->db->order_by('RegDate','DESC')->limit(3)->get_where('tbv_buku', 'Flag_New = "Y"')->result();
		$data['rekom_book'] = $this->db->query('SELECT a.* FROM tbv_buku a WHERE a.IdKategori IN (SELECT b.IdKategori FROM tbl_rekom b WHERE b.IdUser = "'.$this->session->userdata('iduser').'")AND a.status_buku = "Y"')->result();
 		$data['buku'] = $this->db->get('tbv_buku')->result();
 		render('siswa/home',$data);
		// $this->load->view('layouts/base_siswa',$data);	
	}

	function get_rekom()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$iduser = $this->session->userdata('iduser');
			$data['rekom'] = $this->db->get_where('tbv_rekom', 'IdUser = "'.$iduser.'"')->result();
			$data['kategori'] = $this->db->query('SELECT a.* FROM tbl_kategori a WHERE a.IdKategori NOT IN (SELECT b.IdKategori FROM tbl_rekom b WHERE b.IdUser = "'.$this->session->userdata('iduser').'")')->result();
			$this->load->view('ajx/edit_rekom', $data);
		}
	}

	function simpan_rekomendasi()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$iduser = $this->session->userdata('iduser');
			if (count($_POST['kategori']) > 0)
			{
				$data = array();
				foreach ($_POST['kategori'] as $key => $rw)
				{
					$data[] = array(
						'IdKategori' => decrypt_url($_POST['kategori'][$key]), 
						'IdUser' => $iduser, 
					);
				}
				$delete = $this->db->delete('tbl_rekom','IdUser = "'.$iduser.'"');
				if ($delete)
				{
					$this->db->insert_batch('tbl_rekom', $data);
					$this->session->set_flashdata('notif','<script>swal("Success","Rekomendasi Berhasil Disimpan","success")</script>');
					redirect('Siswa');
				}
				else
				{
					$this->session->set_flashdata('notif','<script>swal("Warning","Rekomendasi Gagal Disimpan","warning")</script>');
					redirect('Siswa');
				}
			}
			else
			{
				$this->session->set_flashdata('notif','<script>swal("Error","Rekomendasi Tidak Boleh Kosong","error")</script>');
				redirect('Siswa');
			}
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
					redirect('Siswa');
				}
			}
			else
			{
				$this->session->set_flashdata('notif', '<script>swal("Warning","Password Lama Salah","warning")</script>');
				redirect('Siswa');
			}
		}
		else
		{
			http_response_code(404);
		}
	}

	function pinjam_buku()
	{
		$data['title'] = 'Peminjaman Buku';
		$data['buku'] = $this->db->get_where('tbv_buku','status_buku = "Y"')->result();
		render('siswa/pinjam_book',$data);
	}


	function get_pinjam()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$idbuku = decrypt_url($this->input->post('arg'));
			$cek = $this->db->get_where('tbv_buku', 'status_buku = "Y" AND IdBuku = "'.$idbuku.'"');
			if ($cek->num_rows() > 0)
			{
				$data['buku'] = $cek->row();
				$this->load->view('ajx/get_pinjam', $data);
			}
			else
			{
				echo "<h4><center>Buku ".$cek->row()->judul_buku." Sudah Di Pinjam</center></h4>";
			}
		}
		else
		{
			http_response_code(404);
		}
	}

	function pinjam()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$idbuku = decrypt_url($this->input->post('arg'));
			$iduser = $this->session->userdata('iduser');
			$awal = $this->input->post('start_date');
			$akhir = $this->input->post('end_date');
			$ket = $this->input->post('ket_pinajm');
			$cek_tgl = date_diff(date_create($awal),date_create($akhir));
			if ($cek_tgl->format("%R%a") < 0)
			{
				$this->session->set_flashdata('notif', '<script>swal("Warning","Tanggal Kembali Harus Lebih Besar Dari Tanggal Pinjam","warning")</script>');
				redirect('Siswa/pinjam_buku');
			}
			else
			{
				$data = array(
					'IdUser' => $iduser,
					'IdBuku' => $idbuku,
					'waktupinjam_pin' => $awal,
					'waktukembali_pin' => $akhir,
					'keterangan_pin' => $ket,
				);

				$this->db->insert('tbl_pinjam', $data);
				$this->session->set_flashdata('notif', '<script>swal("Success","Peminjaman Buku Berhasil Di Ajukan\nSilakan Mengambil Buku","success")</script>');
				redirect('Siswa/pinjam_buku');
			}
		}
		else
		{
			http_response_code(404);
		}
	}

	function history_pinjam()
	{
		$data['title'] = 'History Peminjaman Buku';
		$data['pinjam'] = $this->db->order_by('RegDate','DESC')->get_where('tbv_history', 'IdUser = "'.$this->session->userdata('iduser').'"')->result();
		render('siswa/history',$data);
	}
}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */