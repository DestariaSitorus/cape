<?php 

	session_start();

	require 'function.php';

	if(!isset($_SESSION["login"])){
		header("Location: login.php");
		exit;
	}

	if(isset($_SESSION["petugas"])){
		if(isset($_GET["ubahRegistrasi"])){
			echo "
					<script>
						alert('Anda Bukan Admin!');
						document.location.href = 'index.php';
					</script>
				";
		}
	}

	if(isset($_GET["ubahRegistrasi"])){
		$id 				= $_GET["ubahRegistrasi"];

		$ubahRegistrasi 	= query("SELECT * FROM pelanggan WHERE PelangganID = '$id'")[0];
	}
	else if(isset($_GET["ubahPenjualan"])){
		$id 				= $_GET["ubahPenjualan"];

		$ubahPenjualan 	= query("SELECT * FROM penjualan WHERE PenjualanID = '$id'")[0];
	}
	else if(isset($_GET["ubahDetailPenjualan"])){
		$id 				= $_GET["ubahDetailPenjualan"];

		$ubahDetailPenjualan 	= query("SELECT * FROM detailpenjualan WHERE DetailID = '$id'")[0];
	}
	else if(isset($_GET["ubahStokBarang"])){
		$id 				= $_GET["ubahStokBarang"];

		$ubahStokBarang 	= query("SELECT * FROM produk WHERE ProdukID = '$id'")[0];
	}

	if(isset($_POST["submit"])){
		if(isset($_GET["ubahRegistrasi"])){
			$PelangganID 	= htmlspecialchars($_POST["PelangganID"]);
			$NamaPelanggan 	= htmlspecialchars($_POST["NamaPelanggan"]);
			$Alamat 		= htmlspecialchars($_POST["Alamat"]);
			$NomorTelepon 	= htmlspecialchars($_POST["NomorTelepon"]);

			$query = "UPDATE pelanggan SET
						PelangganID 	= '$PelangganID',
						NamaPelanggan 	= '$NamaPelanggan',
						Alamat 			= '$Alamat',
						NomorTelepon 	= '$NomorTelepon'
				WHERE 	PelangganID 	= $PelangganID
					";

			mysqli_query($conn, $query);

			header("Location: index.php?tabelRegistrasi");
			exit;
		}
		else if(isset($_GET["ubahPenjualan"])){
			$PenjualanID 		= htmlspecialchars($_POST["PenjualanID"]);
			$TanggalPenjualan 	= htmlspecialchars($_POST["TanggalPenjualan"]);
			$TotalHarga 		= htmlspecialchars($_POST["TotalHarga"]);
			$PelangganID 		= htmlspecialchars($_POST["PelangganID"]);

			$query = "UPDATE penjualan SET
						PenjualanID 		= '$PenjualanID',
						TanggalPenjualan 	= '$TanggalPenjualan',
						TotalHarga 			= '$TotalHarga',
						PelangganID 		= '$PelangganID'
				WHERE 	PenjualanID 		= $PenjualanID
					";

			mysqli_query($conn, $query);

			header("Location: index.php?tabelPenjualan");
			exit;
		}
		else if(isset($_GET["ubahDetailPenjualan"])){
			$DetailID 		= htmlspecialchars($_POST["DetailID"]);
			$PenjualanID 	= htmlspecialchars($_POST["PenjualanID"]);
			$ProdukID 		= htmlspecialchars($_POST["ProdukID"]);
			$JumlahProduk 	= htmlspecialchars($_POST["JumlahProduk"]);
			$Subtotal 		= htmlspecialchars($_POST["Subtotal"]);

			$query = "UPDATE detailpenjualan SET
						DetailID 		= '$DetailID',
						PenjualanID 	= '$PenjualanID',
						ProdukID 		= '$ProdukID',
						JumlahProduk 	= '$JumlahProduk',
						Subtotal 		= '$Subtotal'
				WHERE 	DetailID 		= $DetailID
					";

			mysqli_query($conn, $query);

			header("Location: index.php?tabelDetailPenjualan");
			exit;
		}
		else if(isset($_GET["ubahStokBarang"])){
			$ProdukID 		= htmlspecialchars($_POST["ProdukID"]);
			$NamaProduk 	= htmlspecialchars($_POST["NamaProduk"]);
			$Harga 			= htmlspecialchars($_POST["Harga"]);
			$Stok 			= htmlspecialchars($_POST["Stok"]);

			$query = "UPDATE produk SET
						ProdukID 		= '$ProdukID',
						NamaProduk 		= '$NamaProduk',
						Harga 			= '$Harga',
						Stok 			= '$Stok'
				WHERE 	ProdukID 		= $ProdukID
					";

			mysqli_query($conn, $query);

			header("Location: index.php?tabelStokBarang");
			exit;
		}
	}

 ?>

<!DOCTYPE html>
<html>
<head>
 <title>Ubah</title>
 <link rel="stylesheet" type="text/css" href="loginStyles.css">
</head>
<body>

	<!-- Ubah Registrasi -->

	<?php if(isset($_GET["ubahRegistrasi"])) : ?>

	<div class="kotak_login">

		<p class="tulisan_login">Ubah Data Pelanggan</p>
		
		<form action="" method="post" enctype="multipart/form-data">

			<input type="hidden" name="PelangganID" class="form_login" placeholder="ID Pelanggan .." required value="<?php echo $ubahRegistrasi["PelangganID"]; ?>">

			<label>Nama Pelanggan</label>
			<input type="text" name="NamaPelanggan" class="form_login" placeholder="Nama Pelanggan .." required value="<?php echo $ubahRegistrasi["NamaPelanggan"]; ?>">
			
			<label>Alamat</label>
			<input type="text" name="Alamat" class="form_login" placeholder="Alamat .." required value="<?php echo $ubahRegistrasi["Alamat"]; ?>">

			<label>Nomor Telepon</label>
			<input type="text" name="NomorTelepon" class="form_login" placeholder="Nomor Telepon .." required value="<?php echo $ubahRegistrasi["NomorTelepon"]; ?>">

			<button type="submit" class="tombol_login" name="submit">Ubah</button>
			
			<br>
			<br>

			<center>
				<a class="link" href="index.php?tabelRegistrasi">Kembali</a>
			</center>

		</form>
	
	</div>

	<?php endif; ?>

	<!-- Ubah Penjualan -->

	<?php if(isset($_GET["ubahPenjualan"])) : ?>

	<div class="kotak_login">

		<p class="tulisan_login">Ubah Data Penjualan</p>
		
		<form action="" method="post" enctype="multipart/form-data">

			<input type="hidden" name="PenjualanID" class="form_login" placeholder="ID Penjualan .." required value="<?php echo $ubahPenjualan["PenjualanID"]; ?>">

			<label>Tanggal Penjualan</label>
			<input type="date" name="TanggalPenjualan" class="form_login" placeholder="Tanggal Penjualan .." required value="<?php echo $ubahPenjualan["TanggalPenjualan"]; ?>">
			
			<label>Total Harga</label>
			<input type="text" name="TotalHarga" class="form_login" placeholder="Total Harga .." required value="<?php echo $ubahPenjualan["TotalHarga"]; ?>">

			<label>ID Pelanggan</label>
			<input type="text" name="PelangganID" class="form_login" placeholder="ID Pelanggan .." required value="<?php echo $ubahPenjualan["PelangganID"]; ?>">

			<button type="submit" class="tombol_login" name="submit">Ubah</button>
			
			<br>
			<br>

			<center>
				<a class="link" href="index.php?tabelPenjualan">Kembali</a>
			</center>

		</form>
	
	</div>

	<?php endif; ?>

	<!-- Ubah Detail Penjualan -->

	<?php if(isset($_GET["ubahDetailPenjualan"])) : ?>

	<div class="kotak_login">

		<p class="tulisan_login">Ubah Data Detail Penjualan</p>
		
		<form action="" method="post" enctype="multipart/form-data">

			<input type="hidden" name="DetailID" class="form_login" placeholder="ID Detail Penjualan .." required value="<?php echo $ubahDetailPenjualan["DetailID"]; ?>">

			<label>ID Penjualan</label>
			<input type="text" name="PenjualanID" class="form_login" placeholder="ID Penjualan .." required value="<?php echo $ubahDetailPenjualan["PenjualanID"]; ?>">
			
			<label>ID Produk</label>
			<input type="text" name="ProdukID" class="form_login" placeholder="ID Produk .." required value="<?php echo $ubahDetailPenjualan["ProdukID"]; ?>">

			<label>Jumlah Produk</label>
			<input type="text" name="JumlahProduk" class="form_login" placeholder="Jumlah Produk .." required value="<?php echo $ubahDetailPenjualan["JumlahProduk"]; ?>">

			<label>Sub Total</label>
			<input type="text" name="Subtotal" class="form_login" placeholder="Sub Total .." required value="<?php echo $ubahDetailPenjualan["Subtotal"]; ?>">

			<button type="submit" class="tombol_login" name="submit">Ubah</button>
			
			<br>
			<br>

			<center>
				<a class="link" href="index.php?tabelDetailPenjualan">Kembali</a>
			</center>

		</form>
	
	</div>

	<?php endif; ?>

	<!-- Ubah Stok Barang -->

	<?php if(isset($_GET["ubahStokBarang"])) : ?>

	<div class="kotak_login">

		<p class="tulisan_login">Ubah Data Stok Barang</p>
		
		<form action="" method="post" enctype="multipart/form-data">

			<input type="hidden" name="ProdukID" class="form_login" placeholder="ID Produk .." required value="<?php echo $ubahStokBarang["ProdukID"]; ?>">

			<label>Nama Produk</label>
			<input type="text" name="NamaProduk" class="form_login" placeholder="Nama Produk .." required value="<?php echo $ubahStokBarang["NamaProduk"]; ?>">
			
			<label>Harga</label>
			<input type="text" name="Harga" class="form_login" placeholder="Harga .." required value="<?php echo $ubahStokBarang["Harga"]; ?>">

			<label>Stok</label>
			<input type="text" name="Stok" class="form_login" placeholder="Stok .." required value="<?php echo $ubahStokBarang["Stok"]; ?>">

			<button type="submit" class="tombol_login" name="submit">Ubah</button>
			
			<br>
			<br>

			<center>
				<a class="link" href="index.php?tabelStokBarang">Kembali</a>
			</center>

		</form>
	
	</div>

	<?php endif; ?>

</body>
</html>