<?php
// // Tambahkan proteksi halaman
// $url_pengalihan = str_replace('index.php/', '', current_url());
// $pengalihan 	= $this->session->set_userdata('pengalihan',$url_pengalihan);
// // Ambil check login dari simple_login
// $this->simple_login->check_login($pengalihan);

// Gabungkan semua bagian layout
require_once('head.php');
require_once('sidebar.php');
require_once('topbar.php');
require_once('rightbar.php');
require_once('footer.php');