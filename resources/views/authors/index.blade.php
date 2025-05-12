<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Author</title>
</head>
<body>
    <h1>BookSales</h1>
    <p>Selamat Datang di Toko BookSales. Dibawah ini adalah list dari author buku yang tersedia</p>

    @foreach($authors as $author)
        <ul>
            <li>ID Author: {{$author['id']}}</li>
            <li>Nama Author: {{$author['name']}}</li>
            <li>Foto Author: {{$author['cover_photo']}}</li>
        </ul>
    @endforeach
</body>
</html>