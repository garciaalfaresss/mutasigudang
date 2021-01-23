<?php
session_start();
//Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","mutasigudang");


//Menambah barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "insert into stok (namabarang, deskripsi, stock) values('$namabarang', '$deskripsi', '$stock')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};


//Menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn,"insert into masukk (idbarang, keterangan, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stok set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}


//Menambah barang keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $kurangkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn,"insert into keluarr (idbarang, penerima, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockkeluar = mysqli_query($conn,"update stok set stock='$kurangkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtokeluar&&$updatestockkeluar){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}


//Update Info Barang
if(isset($_POST['updatebarang'])){
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn,"update stok set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idbarang'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        Header('location:index.php');
    }
}


//Menghapus barang dari stock
if(isset($_POST['hapusbarang'])){
    $idbarang = $_POST['idbarang'];

    $hapus = mysqli_query($conn,"delete from stok where idbarang='$idbarang'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}


//Mengubah data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idbarang = $_POST['idbarang'];
    $idmasuk = $_POST['idmasuk'];
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"select * from stok where idbarang='$idbarang'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn,"select * from masukk where idmasuk='$idmasuk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stok set stock='$kurangin' where idbarang='$idbarang'");
        $updatenya = mysqli_query($conn,"update masukk set qty='$qty', keterangan='$keterangan' where idmasuk='$idmasuk'");
        if($kuranginstocknya&&$updatenya){
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    } else {
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg - $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stok set stock='$kurangin' where idbarang='$idbarang'");
        $updatenya = mysqli_query($conn,"update masukk set qty='$qty', keterangan='$keterangan' where idmasuk='$idmasuk'");
        if($kuranginstocknya&&$updatenya){
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    }
}


//Menghapus barang masuk

if(isset($_POST['hapusbarangmasuk'])){
    $idbarang = $_POST['idbarang'];
    $qty = $_POST['kty'];
    $idmasuk = $_POST['idmasuk'];

    $getdatastock = mysqli_query($conn,"select * from stok where idbarang='$idbarang'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock-$qty;

    $update = mysqli_query($conn,"update stok set stock='$selisih' where idbarang='$idbarang'");
    $hapusdata = mysqli_query($conn,"delete from masukk where idmasuk='$idmasuk'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
}


//Mengubah barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idbarang = $_POST['idbarang'];
    $idkeluar = $_POST['idkeluar'];
    $namabarang = $_POST['namabarang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"select * from stok where idbarang='$idbarang'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn,"select * from keluarr where idkeluar='$idkeluar'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stok set stock='$kurangin' where idbarang='$idbarang'");
        $updatenya = mysqli_query($conn,"update keluarr set qty='$qty', penerima='$penerima' where idkeluar='$idkeluar'");
        if($kuranginstocknya&&$updatenya){
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg - $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stok set stock='$kurangin' where idbarang='$idbarang'");
        $updatenya = mysqli_query($conn,"update keluarr set qty='$qty', penerima='$penerima' where idkeluar='$idkeluar'");
        if($kuranginstocknya&&$updatenya){
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    }
}


//Menghapus barang keluar

if(isset($_POST['hapusbarangkeluar'])){
    $idbarang = $_POST['idbarang'];
    $qty = $_POST['kty'];
    $idkeluar = $_POST['idkeluar'];

    $getdatastock = mysqli_query($conn,"select * from stok where idbarang='$idbarang'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock-$qty;

    $update = mysqli_query($conn,"update stok set stock='$selisih' where idbarang='$idbarang'");
    $hapusdata = mysqli_query($conn,"delete from keluarr where idkeluar='$idkeluar'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }
}


?>