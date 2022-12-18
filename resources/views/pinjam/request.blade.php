@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="rew justify-content-center">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h1>Daftar permintaan</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama peminjam</th>
                                    <th scope="col">Kode buku</th>
                                    <th scope="col">Tanggal pinjam</th>
                                    <th scope="col">Batas pinjam</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pinjams as $pinjam)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $pinjam->user->name }}</td>
                                        <td>{{ $pinjam->buku->kode }}</td>
                                        <td>{{ $pinjam->tanggal_pinjam }}</td>
                                        <td>{{ $pinjam->batas_pinjam }}</td>
                                        <td><a href="/pinjam/request/tolak/{{ $pinjam->id }}">Tolak</a> || <a
                                                href="/pinjam/request/terima/{{ $pinjam->id }}">Terima</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- add Modal -->
    <div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add pinjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/pinjam/add" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kode</label>
                            <input type="text" class="form-control" name="kode" value="{{ old('kode') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Baris</label>
                            <input type="number" class="form-control" name="baris" value="{{ old('baris') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kolom</label>
                            <input type="number" class="form-control" name="kolom" value="{{ old('kolom') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- update Modal -->
    @foreach ($pinjams as $pinjam)
        <div class="modal fade" id="update{{ $pinjam->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update pinjam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/pinjam/update/{{ $pinjam->id }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Kode</label>
                                <input type="text" class="form-control" name="kode" value="{{ $pinjam->kode }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Baris</label>
                                <input type="number" class="form-control" name="baris" value="{{ $pinjam->baris }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kolom</label>
                                <input type="number" class="form-control" name="kolom" value="{{ $pinjam->kolom }}"
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
    @endforeach
@endsection
