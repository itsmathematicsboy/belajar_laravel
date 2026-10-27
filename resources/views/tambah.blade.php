@extends('belajar')
@section('content')
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
@endsection
