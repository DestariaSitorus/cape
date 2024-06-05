<?php 

	session_start();

	require 'function.php';

	if(!isset($_SESSION["login"])){
		header("Location: login.php");
		exit;
	}

	if(isset($_SESSION["petugas"])){
		if(isset($_GET["hapusRegistrasi"])){
			echo "
					<script>
						alert('Anda Bukan Admin!');
						document.location.href = 'index.php';
					</script>
				";
		}
	}

	if(isset($_GET["hapusRegistrasi"])){
		$id 		= $_GET["hapusRegistrasi"];

		$query = "DELETE FROM pelanggan WHERE PelangganID = '$id'";

		mysqli_query($conn, $query);

		header("Location: index.php?tabelRegistrasi");
		exit;
	}
	else if(isset($_GET["hapusPenjualan"])){
		$id 		= $_GET["hapusPenjualan"];

		$query = "DELETE FROM penjualan WHERE PenjualanID = '$id'";

		mysqli_query($conn, $query);

		header("Location: index.php?tabelPenjualan");
		exit;
	}
	else if(isset($_GET["hapusDetailPenjualan"])){
		$id 		= $_GET["hapusDetailPenjualan"];

		$query = "DELETE FROM detailpenjualan WHERE DetailID = '$id'";

		mysqli_query($conn, $query);

		header("Location: index.php?tabelDetailPenjualan");
		exit;
	}
	else if(isset($_GET["hapusStokBarang"])){
		$id 		= $_GET["hapusStokBarang"];

		$query = "DELETE FROM produk WHERE ProdukID = '$id'";

		mysqli_query($conn, $query);

		header("Location: index.php?tabelStokBarang");
		exit;
	}

 ?>