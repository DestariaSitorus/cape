<?php 

	session_start();

	require 'function.php';

	if(!isset($_SESSION["login"])){
		header("Location: login.php");
		exit;
	}

	if(isset($_SESSION["petugas"])){
		if(isset($_GET["tambahRegistrasi"])){
			echo "
					<script>
						alert('Anda Bukan Admin!');
						document.location.href = 'index.php';
					</script>
				";
		}
	}

	if(isset($_POST["submit"])){
		if(isset($_GET["tambahRegistrasi"])){
			$PelangganID 	= htmlspecialchars($_POST["PelangganID"]);
			$NamaPelanggan 	= htmlspecialchars($_POST["NamaPelanggan"]);
			$Alamat 		= htmlspecialchars($_POST["Alamat"]);
			$NomorTelepon 	= htmlspecialchars($_POST["NomorTelepon"]);

			$query = "INSERT INTO pelanggan VALUES ('$PelangganID', '$NamaPelanggan', '$Alamat', '$NomorTelepon')";

			mysqli_query($conn, $query);

			header("Location: index.php?tabelRegistrasi");
			exit;
		}
		else if(isset($_GET["tambahPenjualan"])){
			$PenjualanID 		= htmlspecialchars($_POST["PenjualanID"]);
			$TanggalPenjualan 	= htmlspecialchars($_POST["TanggalPenjualan"]);
			$TotalHarga 		= htmlspecialchars($_POST["TotalHarga"]);
			$PelangganID 		= htmlspecialchars($_POST["PelangganID"]);

			$query = "INSERT INTO penjualan VALUES ('$PenjualanID', '$TanggalPenjualan', '$TotalHarga', '$PelangganID')";

			mysqli_query($conn, $query);

			header("Location: index.php?tabelPenjualan");
			exit;
		}
		else if(isset($_GET["tambahDetailPenjualan"])){
			$DetailID 		= htmlspecialchars($_POST["DetailID"]);
			$PenjualanID 	= htmlspecialchars($_POST["PenjualanID"]);
			$ProdukID 		= htmlspecialchars($_POST["ProdukID"]);
			$JumlahProduk 		= htmlspecialchars($_POST["JumlahProduk"]);
			$Subtotal 		= htmlspecialchars($_POST["Subtotal"]);

			$query = "INSERT INTO detailpenjualan VALUES ('$DetailID', '$PenjualanID', '$ProdukID', '$JumlahProduk', '$Subtotal')";

			mysqli_query($conn, $query);

			header("Location: index.php?tabelDetailPenjualan");
			exit;
		}
		else if(isset($_GET["tambahStokBarang"])){
			$ProdukID 		= htmlspecialchars($_POST["ProdukID"]);
			$NamaProduk 	= htmlspecialchars($_POST["NamaProduk"]);
			$Harga 			= htmlspecialchars($_POST["Harga"]);
			$Stok 			= htmlspecialchars($_POST["Stok"]);

			$query = "INSERT INTO produk VALUES ('$ProdukID', '$NamaProduk', '$Harga', '$Stok')";

			mysqli_query($conn, $query);

			header("Location: index.php?tabelStokBarang");
			exit;
		}
	}

 ?>

<!DOCTYPE html>
<html>
<head>
 <title>Tambah</title>
 <link rel="stylesheet" type="text/css" href="loginStyles.css">
</head>
<body>

	<!-- Tambah Registrasi -->

	<?php if(isset($_GET["tambahRegistrasi"])) : ?>

	<div class="kotak_login">

		<p class="tulisan_login">Tambah Data Pelanggan</p>
		
		<form action="" method="post" enctype="multipart/form-data">

			<label>ID Pelanggan</label>
			<input type="text" name="PelangganID" class="form_login" placeholder="ID Pelanggan .." required>

			<label>Nama Pelanggan</label>
			<input type="text" name="NamaPelanggan" class="form_login" placeholder="Nama Pelanggan .." required>
			
			<label>Alamat</label>
			<input type="text" name="Alamat" class="form_login" placeholder="Alamat .." required>

			<label>Nomor Telepon</label>
			<input type="text" name="NomorTelepon" class="form_login" placeholder="Nomor Telepon .." required>

			<button type="submit" class="tombol_login" name="submit">Tambah</button>
			
			<br>
			<br>

			<center>
				<a class="link" href="index.php?tabelRegistrasi">Kembali</a>
			</center>

		</form>
	
	</div>

	<?php endif; ?>

	<!-- Tambah Penjualan -->

	<?php if(isset($_GET["tambahPenjualan"])) : ?>

	<div class="kotak_login">

		<p class="tulisan_login">Tambah Data Penjualan</p>
		
		<form action="" method="post" enctype="multipart/form-data">

			<label>ID Penjualan</label>
			<input type="text" name="PenjualanID" class="form_login" placeholder="ID Penjualan .." required>

			<label>Tanggal Penjualan</label>
			<input type="date" name="TanggalPenjualan" class="form_login" placeholder="Tanggal Penjualan .." required>
			
			<label>Total Harga</label>
			<input type="text" name="TotalHarga" class="form_login" placeholder="Total Harga .." required>

			<label>ID Pelanggan</label>
			<input type="text" name="PelangganID" class="form_login" placeholder="ID Pelanggan .." required>

			<button type="submit" class="tombol_login" name="submit">Tambah</button>
			
			<br>
			<br>

			<center>
				<a class="link" href="index.php?tabelPenjualan">Kembali</a>
			</center>

		</form>
	
	</div>

	<?php endif; ?>

	<!-- Tambah Detail Penjualan -->

	<?php if(isset($_GET["tambahDetailPenjualan"])) : ?>

	<div class="kotak_login">

		<p class="tulisan_login">Tambah Data Detail Penjualan</p>
		
		<form action="" method="post" enctype="multipart/form-data">

			<label>ID Detail Penjualan</label>
			<input type="text" name="DetailID" class="form_login" placeholder="ID Detail Penjualan .." required>

			<label>ID Penjualan</label>
			<input type="text" name="PenjualanID" class="form_login" placeholder="ID Penjualan .." required>
			
			<label>ID Produk</label>
			<input type="text" name="ProdukID" class="form_login" placeholder="ID Produk .." required>

			<label>Jumlah Produk</label>
			<input type="text" name="JumlahProduk" class="form_login" placeholder="Jumlah Produk .." required>

			<label>Sub Total</label>
			<input type="text" name="Subtotal" class="form_login" placeholder="Sub Total .." required>

			<button type="submit" class="tombol_login" name="submit">Tambah</button>
			
			<br>
			<br>

			<center>
				<a class="link" href="index.php?tabelDetailPenjualan">Kembali</a>
			</center>

		</form>
	
	</div>

	<?php endif; ?>

	<!-- Tambah Stok Barang -->

	<?php if(isset($_GET["tambahStokBarang"])) : ?>

	<div class="kotak_login">

		<p class="tulisan_login">Tambah Data Stok Barang</p>
		
		<form action="" method="post" enctype="multipart/form-data">

			<label>ID Produk</label>
			<input type="text" name="ProdukID" class="form_login" placeholder="ID Produk .." required>

			<label>Nama Produk</label>
			<input type="text" name="NamaProduk" class="form_login" placeholder="Nama Produk .." required>
			
			<label>Harga</label>
			<input type="text" name="Harga" class="form_login" placeholder="Harga .." required>

			<label>Stok</label>
			<input type="text" name="Stok" class="form_login" placeholder="Stok .." required>

			<button type="submit" class="tombol_login" name="submit">Tambah</button>
			
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