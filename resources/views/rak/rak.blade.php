@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="rew justify-content-center">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                            Add kategory
                        </button>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Baris</th>
                                    <th scope="col">Kolom</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($raks as $rak)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $rak->kode }}</td>
                                        <td>{{ $rak->baris }}</td>
                                        <td>{{ $rak->kolom }}</td>
                                        <td><a href="" data-bs-toggle="modal"
                                                data-bs-target="#update{{ $rak->id }}">Update</a> || <a
                                                href="/rak/delete/{{ $rak->id }}">Delete</a></td>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add rak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/rak/add" method="POST">
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
    @foreach ($raks as $rak)
        <div class="modal fade" id="update{{ $rak->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update rak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/rak/update/{{ $rak->id }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Kode</label>
                                <input type="text" class="form-control" name="kode" value="{{ $rak->kode }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Baris</label>
                                <input type="number" class="form-control" name="baris" value="{{ $rak->baris }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kolom</label>
                                <input type="number" class="form-control" name="kolom" value="{{ $rak->kolom }}"
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
