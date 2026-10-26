<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Belajar Laravel" }}</title>
</head>

<body>
    <h1>Belajar Matematika Dasar</h1>
    <a href="{{ route('tambah') }}">Tambah-tambahan</a>
    <a href="{{ route('kurang') }}">Pengurangan</a>
    <a href="{{ route('bagi') }}">Bagi-bagian</a>
    <a href="{{ route('kali') }}">Perkalian</a>

    <a href="{{ url()->previous() }}">Kembali</a>
    <br>

    <br>
    <form action="{{ route('actionTambah') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Angka 1</label>
            <input type="number" name="angka1" placeholder="Masukan Angka">
        </div>
        <br>
        <div class="form-group">
            <label for="">Angka 2</label>
            <input type="number" name="angka2" placeholder="Masukan Angka">
        </div>
        <br>
        <div class="form-group">
            <button type="submit">Total</button>
        </div>
    </form>
    <br>
    <h1>Hasilnya adalah {{ $jumlah ?? 0 }}</h1>
</body>

</html>
