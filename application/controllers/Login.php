<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    function index()
    {
        if ($this->session->userdata('is_login') == true AND $this->session->userdata('role') == 'admin')
        {
            redirect('Admin');
        }
        else if ($this->session->userdata('is_login') == true AND $this->session->userdata('role') == 'siswa')
        {
            redirect('Siswa');
        }
        else
        {
            $this->load->view('login');
        }
    }

    function login_proses()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $this->load->model('M_login','login');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $where = array(
                'username' => $username,
                'password' => md5($password)
            );

            $cek = $this->login->cek('tbv_login', $where);
            if ($cek->num_rows() > 0)
            {
                $user = $cek->row();
                if ($user->StatusLogin == 'ON')
                {
                    $this->session->set_flashdata('notif', '<div class="alert alert-warning alert-dismissable" style=""><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center>User Sedang Aktif <a href="' . site_url('reset/'.encrypt_url($user->IdLogin)).'" title="" >Klik Disini Untuk Reset</a></center></div>');
                    redirect('Login');
                }
                else if(($user->Role == 'admin' AND $user->StatusLogin == 'OFF') AND ($user->flag_acc == 'Y'))
                {
                    $status = array(
                        'StatusLogin' => 'ON',
                        'LastLogin' =>  date('Y-m-d H:i:s'),
                    );
                    $where = array('IdLogin' => $user->IdLogin,);
                    $this->db->update('tbl_login', $status, $where);

                    $data_session = array(
                        'idlogin' => $user->IdLogin,
                        'iduser' => $user->IdUser,
                        'nis_nip' => $user->nis_nip,
                        'username' => $user->username,
                        'nama' => $user->nama,
                        'email' => $user->email,
                        'status' => $user->StatusLogin,
                        'role' => $user->Role,
                        'LastLogin' => $user->LastLogin,
                        'foto' => $user->foto,
                        'is_login' => true,
                    );

                    $welcome = '<script>swal("Welcome to dashboard '.$user->nama.'","Keep Smile 😘🙌👍","success");</script>';
                    $this->session->set_userdata($data_session);
                    $this->session->set_flashdata('notif', $welcome);
                    redirect('Admin');
                }
                else if($user->Role == 'siswa' AND $user->flag_acc == 'Y')
                {
                    $data_session = array(
                        'idlogin' => $user->IdLogin,
                        'iduser' => $user->IdUser,
                        'username' => $user->username,
                        'nis_nip' => $user->nis_nip,
                        'nama' => $user->nama,
                        'email' => $user->email,
                        'status' => $user->StatusLogin,
                        'role' => $user->Role,
                        'LastLogin' => $user->LastLogin,
                        'foto' => $user->foto,
                        'is_login' => true,
                    );
                    $welcome = '<script>swal("Welcome to dashboard '.$user->nama.'","Keep Smile 😘🙌👍","success");</script>';
                    $this->session->set_userdata($data_session);
                    $this->session->set_flashdata('notif', $welcome);
                    redirect('Siswa');
                }
                else
                {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissable" style=""><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center>Akun Anda Belum Disetujui Admin</center></div>');
                    redirect('Login');
                }
            }
            else
            {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissable" style=""><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center>Username & Password Salah 😭😭</center></div>');
                redirect('Login');
            }
        }
        else
        {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissable" style=""><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center>Request Method '.$this->input->server('REQUEST_METHOD').' Tidak Di Dukung 💩</center></div>');
            redirect('Login');
        }
    }

    function reset($idlogin = false)
    {
        if ($idlogin != false)
        {
            $idlogin = decrypt_url($idlogin);
            $this->db->update('tbl_login', array('StatusLogin' => 'OFF'), array('IdLogin' => $idlogin));
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissable" style="width:100%;"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center>Status Login Berhasil Di Reset 🙌</center></div>');
            redirect('Login');
        }
    }

    function register()
    {
        $data['kategori'] = $this->db->get('tbl_kategori')->result();
        $this->load->view('register',$data);
    }

    function daftar()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $nis = $this->input->post('nis');
            $nama = $this->input->post('nama');
            $tahun = $this->input->post('tahun');
            $nohp = $this->input->post('nohp');
            $email = $this->input->post('email');
            $alamat = $this->input->post('alamat');
            $password = md5($this->input->post('password'));
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
                'id_telegram' => $id_telegram, 
                'foto' => $foto, 
                'flag_acc' => 'N', 
            );

            $cek = $this->db->get_where('tbl_users', 'nis_nip = "'.$nis.'" or email = "'.$email.'"');
            if ($cek->num_rows() > 0)
            {
                $this->session->set_flashdata('notif','<script>swal("Warning","NIP/NIS/E-Mail Sudah Ada","warning")</script>');
                redirect('register');
            }
            else
            {
                $this->db->insert('tbl_users', $data);
                $data_login = array(
                    'IdUser' => $ids, 
                    'username' => $email, 
                    'password' => $password, 
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
                
                $msg_admin = "INFO ‼\nUser Baru Berhasil Mendaftar\nSilakan Lakukan Persetujuan\nDetail Akun\nNIS : $nis \nNama : $nama \nEmail:$email";
                $msg_user = "Anda Berhasil Mendaftar, Silakan Menunggu Persetujuan Admin";
                notif_admin($msg_admin);
                if (sendMessage($msg_user,$id_telegram))
                {
                    $this->session->set_flashdata('notif','<script>swal("Success","Anda Berhasil Mendaftar, Silakan Menunggu Persetujuan Admin","success")</script>');
                    redirect('Login');
                }
                else
                {
                    $this->session->set_flashdata('notif','<script>swal("Warning","Anda Berhasil Mendaftar, ID Telegram Anda Salah","warning")</script>');
                    redirect('Login');
                }
            }
        }
        else
        {
            http_response_code(404);
        }
    }

    function logout()
    {
        $status = array('StatusLogin' => 'OFF');
        $where = array('IdLogin' => $this->session->userdata('idlogin'),);
        $this->db->update('tbl_login', $status, $where);
        $this->session->sess_destroy();
        redirect('Login');
    }

}

/* End of file Login.php */
