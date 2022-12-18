@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-6 mb-3">
                <img src="/img/{{ $buku->cover }}" class="rounded" alt="..." style="width: 300px; height: 400px">
                <br>
                <a href="" class="mb-3" data-bs-toggle="modal" data-bs-target="#cover">
                    Update cover
                </a>

                <p>Kode buku : <span class="text-danger">{{ $buku->kode }}</span></p>
                <p>Stok : <span class="text-danger">{{ $buku->stok }}</span></p>
                <p>Kategori : <span class="text-danger">{{ $buku->kategori->kategori }}</span></p>
                <p>Rak : <span class="text-danger">{{ $buku->rak->kode }}</span> | Baris :
                    <span class="text-danger">{{ $buku->rak->baris }} </span> | Kolom : <span
                        class="text-danger">{{ $buku->rak->kolom }} </span>
                </p>
                <h3 class="card-title">{{ $buku->judul }}</h3>
                <h6>Sipnosis</h6>
                <p>{!! nl2br($buku->sinopsis) !!}</p>
                @if (Auth::user()->role == 'admin')
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail">Edit</a>
                    <a href="/buku/delete/{{ $buku->id }}" class="btn btn-primary"
                        onclick="return confirm('Hapsu buku!')">Delete</a>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#pinjamAdmin">Pinjam</a>
                @else
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamUser">Pinjam</a>
                @endif
            </div>
        </div>
    </div>


    <!-- cover Modal -->
    <div class="modal fade" id="cover" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update cover</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/buku/update/cover/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Cover</label>
                            <input type="file" class="form-control" name="cover" value="{{ old('cover') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- detail Modal -->
    <div class="modal fade" id="detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/buku/update/detail/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" value="{{ $buku->judul }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode</label>
                            <input type="text" class="form-control" name="kode" value="{{ $buku->kode }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" value="{{ $buku->penerbit }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sinopsis</label>
                            <textarea class="form-control" rows="5" name="sinopsis" required>{!! $buku->sinopsis !!}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="id_kategori" required>
                                <option value="{{ $buku->id_kategori }}" selected>
                                    {{ $buku->kategori->kategori }}
                                </option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rak</label>
                            <select class="form-select" name="id_rak" required>
                                <option value="{{ $buku->id_rak }}" selected>Kode : {{ $buku->rak->kode }} | Baris :
                                    {{ $buku->rak->baris }} | Kolom : {{ $buku->rak->kolom }}</option>
                                @foreach ($raks as $rak)
                                    <option value="{{ $rak->id }}">Kode : {{ $rak->kode }} | Baris :
                                        {{ $rak->baris }} | Kolom : {{ $rak->kolom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stok" value="{{ $buku->stok }}"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- detail Modal -->
    <div class="modal fade" id="pinjamAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Data pinjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/pinjam/admin/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">ID User</label>
                            <input type="number" class="form-control" name="id_user" value="{{ old('id_user') }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Batas pinjam</label>
                            <input type="date" class="form-control" name="batas_pinjam"
                                value="{{ old('batas_pinjam') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pinjam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- detail Modal -->
    <div class="modal fade" id="pinjamUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Request pinjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/pinjam/user/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Batas pinjam</label>
                            <input type="date" class="form-control" name="batas_pinjam"
                                value="{{ old('batas_pinjam') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
