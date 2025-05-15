<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Buku</title>
</head>
<body>
    <h1>BookSales</h1>
    <p>Selamat Datang di Toko BookSales. Dibawah ini adalah list dari buku yang tersedia</p>

    @foreach($books as $item)
        <ul>
            <li>Judul Buku: {{$item['title']}}</li>
            <li>Deskripsi: {{$item['description']}}</li>
            <li>Harga: {{$item['price']}}</li>
            <li>Cover Photo: {{$item['cover_photo']}}</li>
            <li>ID Genre: {{$item['genre_id']}}</li>
            <li>ID Author: {{$item['author_id']}}</li>
        </ul>
    @endforeach
</body>
</html>