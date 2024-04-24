<?php
    session_start();
	echo "
        <script>
        alert('Anda tidak dapat melakukan aksi ini, anda harus melakukan login terlebih dahulu!');
        location.href='../index.php';
        </script>
        ";
?>