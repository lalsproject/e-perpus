<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	function pdf($file = false)
	{
		if ($file != false)
		{
			$data['file'] = $file;
			$this->load->view('pdf_view', $data);
		}
	}

	function mig()
	{
		$this->load->library('Sqltoci');

        // All Tables:

        $this->sqltoci->generate();
	}

	function notif()
	{
		$tgl = date('Y-m-d');
		$data = $this->db->query("
			SELECT a.*, DATEDIFF(DATE(CURDATE()),a.waktukembali_pin) AS flag_wktu FROM tbv_history a WHERE DATEDIFF(DATE(CURDATE()),a.waktukembali_pin) >= -1 AND a.status_kembali != 'Y'
		")->result();
		if ($data != null)
		{
			foreach ($data as $d)
			{
				$msg = "";
				if ($d->flag_wktu == -1)
				{
					//besok
					$msg = "INFO ‼\nHallo ".$d->nama." 👋\nBuku Yang Anda Pinjam Besok Sudah Harus Di Kembalikan Agar Tidak Di Kenakan Denda.\nBuku : $d->judul_buku \nTanggal Pinjam : ".date('d/m/Y',strtotime($d->waktupinjam_pin))."\nTanggal Kembali : ".date('d/m/Y',strtotime($d->waktukembali_pin))."";
				}
				else if($d->flag_wktu == 0)
				{
					//hari ini
					$msg = "INFO ‼\nHallo ".$d->nama." 👋\nBuku Yang Anda Pinjam Sudah Harus Di Kembalikan Hari Ini Agar Tidak Di Kenakan Denda.\nBuku : $d->judul_buku \nTanggal Pinjam : ".date('d/m/Y',strtotime($d->waktupinjam_pin))."\nTanggal Kembali : ".date('d/m/Y',strtotime($d->waktukembali_pin))."";
				}
				else if($d->flag_wktu > 0)
				{
					//denda
					$msg = "INFO ‼\nHallo ".$d->nama." 👋\nBuku Yang Anda Pinjam Sudah Harus Di Kembalikan.\nBuku : $d->judul_buku \nTanggal Pinjam : ".date('d/m/Y',strtotime($d->waktupinjam_pin))."\nTanggal Kembali : ".date('d/m/Y',strtotime($d->waktukembali_pin))."\nTerlambat : ".$d->flag_wktu." Hari\nDenda : ".rupiah($d->denda_pinjam);
				}
				
				sendMessage($msg,$d->id_telegram);
				// echo json_encode($msg);
			}
		}
		echo "SUKSES";
	}

	function coba_admin()
	{
		notif_admin("COBA");
	}
}
