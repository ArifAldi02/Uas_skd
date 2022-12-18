@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="rew justify-content-center">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h1>Daftar pinjam</h1>
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
                                        <td><a href="/kembali/{{ $pinjam->id }}">Selesai</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (Auth::user()->role == 'user')
                        <div class="col-12">
                            <h1>Menunggu konfirmasi</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama peminjam</th>
                                        <th scope="col">Kode buku</th>
                                        <th scope="col">Tanggal pinjam</th>
                                        <th scope="col">Batas pinjam</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendings as $pending)
                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $pending->user->name }}</td>
                                            <td>{{ $pending->buku->kode }}</td>
                                            <td>{{ $pending->tanggal_pinjam }}</td>
                                            <td>{{ $pending->batas_pinjam }}</td>
                                            <td>{{ $pending->status }}</td>
                                            <td><a href="/pinjam/request/tolak/{{ $pending->id }}">Batal</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
