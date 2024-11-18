<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_base extends CI_Migration {

	public function up() {

		## Create Table tbl_buku
		$this->dbforge->add_field(array(
			'IdBuku' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE,
				'auto_increment' => TRUE
			),
			'IdKategori' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE,

			),
			'tipe_buku' => array(
				'type' => 'ENUM("E-BOOK","BUKU")',
				'null' => FALSE,

			),
			'judul_buku' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => FALSE,

			),
			'pengarang_buku' => array(
				'type' => 'VARCHAR',
				'constraint' => 60,
				'null' => FALSE,

			),
			'tahun_buku' => array(
				'type' => 'INT',
				'constraint' => 5,
				'null' => FALSE,

			),
			'ebook_buku' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => TRUE,

			),
			'daftarisi_buku' => array(
				'type' => 'TEXT',
				'null' => FALSE,

			),
			'status_buku' => array(
				'type' => 'ENUM("Y","N")',
				'null' => FALSE,

			),
			'jmlh_buku' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE,
				'default' => '0',

			),
			'harga_denda' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE,

			),
			'RegDate' => array(
				'type' => 'DATETIME',
				'null' => FALSE,
				'default' => 'current_timestamp()',

			),
		));
		$this->dbforge->add_key("IdBuku",true);
		$this->dbforge->create_table("tbl_buku", TRUE);
		$this->db->query('ALTER TABLE  `tbl_buku` ENGINE = InnoDB');

		## Create Table tbl_kategori
		$this->dbforge->add_field(array(
			'IdKategori' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE,
				'auto_increment' => TRUE
			),
			'NamaKategori' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => TRUE,

			),
			'Ket_Kategori' => array(
				'type' => 'TEXT',
				'null' => TRUE,

			),
			'RegDate' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
				'default' => 'current_timestamp()',

			),
		));
		$this->dbforge->add_key("IdKategori",true);
		$this->dbforge->create_table("tbl_kategori", TRUE);
		$this->db->query('ALTER TABLE  `tbl_kategori` ENGINE = InnoDB');

		## Create Table tbl_login
		$this->dbforge->add_field(array(
			'IdLogin' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE,
				'auto_increment' => TRUE
			),
			'IdUser' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE,
				'default' => '0',

			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => FALSE,

			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE,

			),
			'Role' => array(
				'type' => 'SET("admin","siswa")',
				'null' => FALSE,

			),
			'LastLogin' => array(
				'type' => 'DATETIME',
				'null' => FALSE,
				'default' => 'current_timestamp()',
				'on update current_timestamp()' => TRUE
			),
			'StatusLogin' => array(
				'type' => 'ENUM("ON","OFF")',
				'null' => FALSE,
				'default' => 'OFF',

			),
			'FlagAktif' => array(
				'type' => 'ENUM("Y","N")',
				'null' => FALSE,
				'default' => 'N',

			),
		));
		$this->dbforge->add_key("IdLogin",true);
		$this->dbforge->create_table("tbl_login", TRUE);
		$this->db->query('ALTER TABLE  `tbl_login` ENGINE = InnoDB');

		## Create Table tbl_pinjam
		$this->dbforge->add_field(array(
			'id_pinjam' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'auto_increment' => TRUE
			),
			'IdUser' => array(
				'type' => 'INT',
				'constraint' => 13,
				'null' => FALSE,

			),
			'IdBuku' => array(
				'type' => 'INT',
				'constraint' => 20,
				'null' => FALSE,

			),
			'waktupinjam_pin' => array(
				'type' => 'DATE',
				'null' => FALSE,

			),
			'waktukembali_pin' => array(
				'type' => 'DATE',
				'null' => TRUE,

			),
			'keterangan_pin' => array(
				'type' => 'TEXT',
				'null' => TRUE,

			),
			'status_pin' => array(
				'type' => 'ENUM("Y","N")',
				'null' => FALSE,
				'default' => 'N',

			),
			'status_kembali' => array(
				'type' => 'ENUM("Y","N")',
				'null' => FALSE,
				'default' => 'N',

			),
			'tgl_kembali' => array(
				'type' => 'DATETIME',
				'null' => FALSE,

			),
			'RegDate' => array(
				'type' => 'DATETIME',
				'null' => FALSE,
				'default' => 'current_timestamp()',

			),
		));
		$this->dbforge->add_key("id_pinjam",true);
		$this->dbforge->create_table("tbl_pinjam", TRUE);
		$this->db->query('ALTER TABLE  `tbl_pinjam` ENGINE = InnoDB');

		## Create Table tbl_rekom
		$this->dbforge->add_field(array(
			'IdKategori' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE,

			),
			'IdUser' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE,

			),
		));

		$this->dbforge->create_table("tbl_rekom", TRUE);
		$this->db->query('ALTER TABLE  `tbl_rekom` ENGINE = InnoDB');

		## Create Table tbl_users
		$this->dbforge->add_field(array(
			'IdUser' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => FALSE,
				'auto_increment' => TRUE
			),
			'nis_nip' => array(
				'type' => 'INT',
				'constraint' => 20,
				'null' => FALSE,

			),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => FALSE,

			),
			'alamat' => array(
				'type' => 'TEXT',
				'null' => FALSE,

			),
			'nohp' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => FALSE,

			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => FALSE,

			),
			'foto' => array(
				'type' => 'TEXT',
				'null' => TRUE,
				'default' => ''default.jpg'',

			),
			'tahunmasuk' => array(
				'type' => 'YEAR',
				'constraint' => 4,
				'null' => FALSE,

			),
			'flag_admin' => array(
				'type' => 'ENUM("Y","N")',
				'null' => FALSE,
				'default' => 'N',

			),
			'flag_acc' => array(
				'type' => 'ENUM("Y","N")',
				'null' => FALSE,
				'default' => 'N',

			),
			'id_telegram' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => FALSE,

			),
			'regdate' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
				'default' => 'current_timestamp()',

			),
		));
		$this->dbforge->add_key("IdUser",true);
		$this->dbforge->create_table("tbl_users", TRUE);
		$this->db->query('ALTER TABLE  `tbl_users` ENGINE = InnoDB');
	 }

	public function down()	{
		### Drop table tbl_buku ##
		$this->dbforge->drop_table("tbl_buku", TRUE);
		### Drop table tbl_kategori ##
		$this->dbforge->drop_table("tbl_kategori", TRUE);
		### Drop table tbl_login ##
		$this->dbforge->drop_table("tbl_login", TRUE);
		### Drop table tbl_pinjam ##
		$this->dbforge->drop_table("tbl_pinjam", TRUE);
		### Drop table tbl_rekom ##
		$this->dbforge->drop_table("tbl_rekom", TRUE);
		### Drop table tbl_users ##
		$this->dbforge->drop_table("tbl_users", TRUE);

	}
}