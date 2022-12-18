@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-12 mb-3">
                @if (Auth::user()->role == 'admin')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                        Tambah buku
                    </button>
                @endif
            </div>
            @foreach ($bukus as $buku)
                <div class="col-3 mb-3">
                    <div class="card" style="width: 300px;">
                        <img src="/img/{{ $buku->cover }}" class="card-img-top rounded" alt="..."
                            style="width: 100%; height: 400px">
                        <div class="card-body">
                            <p class="card-text">Kategori : {{ $buku->kategori->kategori }}</p>
                            <p class="card-text">Rak : <span class="text-danger">{{ $buku->rak->kode }}</span> | Baris :
                                <span class="text-danger">{{ $buku->rak->baris }} </span> | Kolom : <span
                                    class="text-danger">{{ $buku->rak->kolom }} </span>
                            </p>
                            <h5 class="card-title">{{ $buku->judul }}</h5>
                            <p class="card-text">{{ substr($buku->sinopsis, 0, 50) }}...</p>
                            <a href="/buku/detail/{{ $buku->id }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- add Modal -->
    <div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/buku/add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" value="{{ old('judul') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode</label>
                            <input type="text" class="form-control" name="kode" value="{{ old('kode') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" value="{{ old('penerbit') }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sinopsis</label>
                            <textarea class="form-control" rows="5" name="sinopsis" required>{!! old('sinopsis') !!}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="id_kategori" required>
                                <option selected disabled>Open this select menu</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rak</label>
                            <select class="form-select" name="id_rak" required>
                                <option selected disabled>Open this select menu</option>
                                @foreach ($raks as $rak)
                                    <option value="{{ $rak->id }}">Kode : {{ $rak->kode }} | Baris :
                                        {{ $rak->baris }} | Kolom : {{ $rak->kolom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stok" value="{{ old('stok') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="file" class="form-control" name="cover" value="{{ old('cover') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
