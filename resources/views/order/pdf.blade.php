<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title> 
</head>
<body>
    <h2>ShCraft</h2>
    <h1>Status Pesanan</h1>
    <p>Nama : {{ $order->getKerajinan->nama }}</p>
    <p>Dipesan Oleh : {{ $order->getPengguna->nama }}</p>
    <p>Kategori : </p>
    <p>nomor rekening : </p>
    
    <table border="1" cellspacing="0" cellpadding="2" align="center" width="400"> 
        <tr align="center" bgcolor="pink">
            <td width="30">ID</th>
            <td width="50">{{ $order->id }}</td>
            </td></tr>    
        
        <tr align="center" bgcolor="pink">
            <td width="30">Jumlah Barang</th>
            <td width="50">{{ $order->jumlah_barang }}</td>
            </td></tr>

        <tr align="center" bgcolor="pink">
            <td width="30">Total Harga</th>
            <td width="50">{{ $order->total_harga }}</td>
            </td></tr>
        
        <tr align="center" bgcolor="pink">
            <td width="30">Waktu</th>
            <td width="50">{{ $order->waktu_dibuat}}</td>
            </td></tr> 

        <tr align="center" bgcolor="pink">
            <td width="30">ID Pengguna</th>
            <td width="50">{{ $order->id_pengguna}}</td>
            </td></tr> 
        
        <tr align="center" bgcolor="pink">
            <td width="30">ID Kerajinan</th>
            <td width="50">{{ $order->id_kerajinan}}</td>
            </td></tr> 
            
        <tr align="center" bgcolor="pink">
            <td width="30">Detail Kerajinan</th>
            <td width="50">{{ $order->getKerajinan->gambar }}</td>
            </td></tr>     

    </table>
    
</body>
</html>