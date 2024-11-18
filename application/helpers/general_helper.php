<?php

function dd($data){
	var_dump($data); 
	die;
}

function adminPage($view, $data = []){
	$CI = &get_instance();
	$data['content'] = $view;
	$CI->load->view('layouts/base_admin', $data);
}

function render($view, $data = []){
	$CI = &get_instance();
	$data['content'] = $view;
	$CI->load->view('layouts/base_siswa', $data);
}

function rupiah($nmbr = false)
{
	if ($nmbr != false)
	{

		return 'Rp. '.str_replace(',', '.', number_format($nmbr));
	}
	else
	{
		return 'Rp. 0';
	}
}

function limitText($text = false)
{
	if ($text != false)
	{
		$num_words = 6;
		$words = array();
		$words = explode(" ", $text, $num_words);
		$shown_string = "";
		if(count($words) == 6){
			$words[5] = " ... ";
		}
		$shown_string = implode(" ", $words);
		return $shown_string;
	}
	else
	{
		return false;
	}
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function photo_uploader($files = false,$kdfile= false)
{
	if ($files != false)
	{
		$CI = &get_instance();
		$files = $_FILES[$kdfile]['name'];
		if (empty($files))
		{
			return false;
		}
		else
		{
			$config = array(
				'upload_path' => './mods/assets/pic/', 
				'allowed_types' => 'jpg|JPG|jpeg|JPEG|png|PNG',
				'file_name' => $kdfile.'-'.date('dmY').'-'.rand(),
			);

			// $CI->load->library('image_lib', $config);
			// $CI->image_lib->resize();
			$CI->load->library('upload', $config);

			if (!$CI->upload->do_upload($kdfile))
			{
				return 'format not allow';
			}
			else
			{
				$gambar = $CI->upload->data('file_name'); 
				$kdfile = "";
				unset($CI->upload);
				return $gambar; 
			}
		}
	}
	else
	{
		return false;
	}
}

function count_siswa()
{
	$CI = &get_instance();
	return $CI->db->get_where('tbl_users','flag_admin != "Y"')->num_rows();
}

function count_admin()
{
	$CI = &get_instance();
	return $CI->db->get_where('tbl_users','flag_admin = "Y"')->num_rows();
}

function count_fisik()
{
	$CI = &get_instance();
	return $CI->db->get_where('tbl_buku','tipe_buku = "BUKU"')->num_rows();
}

function count_digital()
{
	$CI = &get_instance();
	return $CI->db->get_where('tbl_buku','tipe_buku != "BUKU"')->num_rows();
}

function sendMessage($message=false,$chat_id = false)
{
    if ($message != false and $chat_id != false)
    {
        $CI =& get_instance();

        $bot_token = $CI->config->item('telegram_bot_token');
        $chat_id = $chat_id; // ID chat atau nomor telepon tujuan pesan Anda

        $telegram_api_url = "https://api.telegram.org/bot$bot_token/sendMessage";

        $data = array(
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'markdown',
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'GET',
                'content' => http_build_query($data),
            ),
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($telegram_api_url, false, $context);
        return true;
        // return json_decode($result,true)['ok'];
    }
    else
    {
        return false;
        // http_response_code(404);
    }
}

function notif_admin($message=false)
{
    if ($message != false)
    {
        $CI =& get_instance();


        $bot_token = $CI->config->item('telegram_bot_token');
       	$admin_id = $CI->db->get_where('tbl_users','flag_admin = "Y"')->result();
        foreach ($admin_id as $ai)
        {
        	$telegram_api_url = "https://api.telegram.org/bot$bot_token/sendMessage";

	        $data = array(
	            'chat_id' => $ai->id_telegram,
	            'text' => $message,
	            'parse_mode' => 'markdown',
	        );

	        $options = array(
	            'http' => array(
	                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	                'method'  => 'GET',
	                'content' => http_build_query($data),
	            ),
	        );

	        $context  = stream_context_create($options);
	        $result = file_get_contents($telegram_api_url, false, $context);
        }
        return true;
        // return json_decode($result,true)['ok'];
    }
    else
    {
        return false;
        // http_response_code(404);
    }
}