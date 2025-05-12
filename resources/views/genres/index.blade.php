<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Genre</title>
</head>
<body>
    <h1>BookSales</h1>
    <p>Selamat Datang di Toko BookSales. Dibawah ini adalah list dari genre buku tersedia</p>

    @foreach($genres as $genre)
        <ul>
            <li>ID Genre: {{$genre['id']}}</li>
            <li>Nama Genre: {{$genre['name']}}</li>
        </ul>
    @endforeach
</body>
</html>