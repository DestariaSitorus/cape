<?php 

	session_start();

	require 'function.php';

	if(!isset($_SESSION["login"])){
		header("Location: login.php");
		exit;
	}

	if(isset($_SESSION["petugas"])){
		if(isset($_GET["cetakRegistrasi"])){
			echo "
					<script>
						alert('Anda Bukan Admin!');
						document.location.href = 'index.php';
					</script>
				";
		}
	}

	$pelanggan 			= query("SELECT * FROM pelanggan");

	$penjualan 			= query("SELECT * FROM penjualan, pelanggan WHERE 
								penjualan.PelangganID = pelanggan.PelangganID");

	$detailPenjualan 	= query("SELECT * FROM detailpenjualan, penjualan, produk, pelanggan WHERE
								detailpenjualan.PenjualanID = penjualan.PenjualanID AND
								detailpenjualan.ProdukID   	= produk.ProdukID 		AND
								penjualan.PelangganID 		= pelanggan.PelangganID");

	$stokBarang 		= query("SELECT * FROM produk");

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Cetak</title>
 </head>
 <body>

 	<!-- Tabel Registrasi -->

	<?php if(isset($_GET["cetakRegistrasi"])) : ?>

        <table border="1" cellpadding="10" cellspacing="0" align="center" style="margin-top:60px;">
        	<tr align="center">
        		<th style="background-color:lime;">ID Pelanggan</th>
        		<th>Nama Pelanggan</th>
        		<th>Alamat</th>
        		<th>Nomor Telepon</th>
        	</tr>

        	<?php foreach($pelanggan as $row) : ?>

        		<tr align="center">
        			<td style="background-color:lime;"><?php echo $row["PelangganID"]; ?></td>
	        		<td><?php echo $row["NamaPelanggan"]; ?></td>
	        		<td><?php echo $row["Alamat"]; ?></td>
	        		<td><?php echo $row["NomorTelepon"]; ?></td>
        		</tr>

        	<?php endforeach; ?>

        </table>

        <script>
        	window.print();
        </script>

	<?php endif; ?>

	<!-- Tabel Penjualan -->

	<?php if(isset($_GET["cetakPenjualan"])) : ?>

        <table border="1" cellpadding="10" cellspacing="0" align="center" style="margin-top:60px;">
        	<tr align="center">
        		<th style="background-color:yellow;">ID Penjualan</th>
        		<th>Tanggal Penjualan</th>
        		<th>Total Harga</th>
        		<th style="background-color:lime;">ID Pelanggan</th>
        		<th>Nama Pelanggan</th>
        		<th>Alamat</th>
        		<th>Nomor Telepon</th>
        	</tr>

        	<?php foreach($penjualan as $row) : ?>

        		<tr align="center">
        			<td style="background-color:yellow;"><?php echo $row["PenjualanID"]; ?></td>
	        		<td><?php echo $row["TanggalPenjualan"]; ?></td>
	        		<td><?php echo $row["TotalHarga"]; ?></td>
	        		<td style="background-color:lime;"><?php echo $row["PelangganID"]; ?></td>
	        		<td><?php echo $row["NamaPelanggan"]; ?></td>
	        		<td><?php echo $row["Alamat"]; ?></td>
	        		<td><?php echo $row["NomorTelepon"]; ?></td>
        		</tr>

        	<?php endforeach; ?>

        </table>

        <script>
        	window.print();
        </script>

	<?php endif; ?>

	<!-- Tabel Detail Penjualan -->

	<?php if(isset($_GET["cetakDetailPenjualan"])) : ?>

        <table border="1" cellpadding="10" cellspacing="0" align="center" style="margin-top:60px;">
        	<tr align="middle">
        		<th style="background-color:skyblue;">ID Detail Penjualan</th>
        		<th style="background-color:yellow;">ID Penjualan</th>
        		<th>Tanggal Penjualan</th>
        		<th>Total Harga</th>
        		<th style="background-color:lime;">ID Pelanggan</th>
        		<th>Nama Pelanggan</th>
        		<th>Alamat</th>
        		<th>Nomor Telepon</th>
        		<th style="background-color:grey;">ID Produk</th>
        		<th>Nama Produk</th>
        		<th>Harga</th>
        		<th>Stok</th>
        		<th style="background-color:skyblue;">Jumlah Produk</th>
        		<th style="background-color:skyblue;">Sub Total</th>
        	</tr>

        	<?php foreach($detailPenjualan as $row) : ?>

        		<tr align="middle">
        			<td style="background-color:skyblue;"><?php echo $row["DetailID"]; ?></td>
        			<td style="background-color:yellow;"><?php echo $row["PenjualanID"]; ?></td>
	        		<td><?php echo $row["TanggalPenjualan"]; ?></td>
	        		<td><?php echo $row["TotalHarga"]; ?></td>
	        		<td style="background-color:lime;"><?php echo $row["PelangganID"]; ?></td>
	        		<td><?php echo $row["NamaPelanggan"]; ?></td>
	        		<td><?php echo $row["Alamat"]; ?></td>
	        		<td><?php echo $row["NomorTelepon"]; ?></td>
	        		<td style="background-color:grey;"><?php echo $row["ProdukID"]; ?></td>
	        		<td><?php echo $row["NamaProduk"]; ?></td>
	        		<td><?php echo $row["Harga"]; ?></td>
	        		<td><?php echo $row["Stok"]; ?></td>
	        		<td style="background-color:skyblue;"><?php echo $row["JumlahProduk"]; ?></td>
	        		<td style="background-color:skyblue;"><?php echo $row["Subtotal"]; ?></td>
        		</tr>

        	<?php endforeach; ?>

        </table>

        <script>
        	window.print();
        </script>

	<?php endif; ?>

	<!-- Tabel Stok Barang -->

	<?php if(isset($_GET["cetakStokBarang"])) : ?>

        <table border="1" cellpadding="10" cellspacing="0" align="center" style="margin-top:60px;">
        	<tr align="center">
        		<th style="background-color:grey;">ID Produk</th>
        		<th>Nama Produk</th>
        		<th>Harga</th>
        		<th>Stok</th>
        	</tr>

        	<?php foreach($stokBarang as $row) : ?>

        		<tr align="center">
        			<td style="background-color:grey;"><?php echo $row["ProdukID"]; ?></td>
	        		<td><?php echo $row["NamaProduk"]; ?></td>
	        		<td><?php echo $row["Harga"]; ?></td>
	        		<td><?php echo $row["Stok"]; ?></td>
        		</tr>

        	<?php endforeach; ?>

        </table>

        <script>
        	window.print();
        </script>

	<?php endif; ?>
 
 </body>
 </html>