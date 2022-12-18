@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="rew justify-content-center">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h1>Daftar riwayat</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama peminjam</th>
                                    <th scope="col">Kode buku</th>
                                    <th scope="col">Tanggal kembali</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayats as $riwayat)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $riwayat->user->name }}</td>
                                        <td>{{ $riwayat->buku->kode }}</td>
                                        @if ($riwayat->tanggal_kembali == null)
                                            <td>Belum dikembalikan</td>
                                        @else
                                            <td>{{ $riwayat->tanggal_kembali }}</td>
                                        @endif
                                        <td>{{ $riwayat->status }}</td>
                                        <td><a href="/riwayat/delete/{{ $riwayat->id }}">Hapus</a></td>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add riwayat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/riwayat/add" method="POST">
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
    @foreach ($riwayats as $riwayat)
        <div class="modal fade" id="update{{ $riwayat->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update riwayat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/riwayat/update/{{ $riwayat->id }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Kode</label>
                                <input type="text" class="form-control" name="kode" value="{{ $riwayat->kode }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Baris</label>
                                <input type="number" class="form-control" name="baris" value="{{ $riwayat->baris }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kolom</label>
                                <input type="number" class="form-control" name="kolom" value="{{ $riwayat->kolom }}"
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
