<?php
// Gabungkan semua bagian layout
require_once('head.php');
require_once('sidebar.php');
require_once('topbar.php');
require_once('rightbar.php');
if ($content) {
    $this->load->view($content);
}
require_once('footer.php');