@extends('Template.sidebar')
@section('title', 'Pengaturan Proyek')
@section('content')
    <h1 class="mt-4">Pengaturan Proyek</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pengaturan Proyek</li>
    </ol>
    <div class="mb-2 ">
        <button class="btn btn-primary" data-bs-target="#addModal" data-bs-toggle="modal">Tambah 
            <i class="fa-solid fa-file-circle-plus"></i></button>
    </div>
    @error('jenis')
        <div class="mb-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @enderror
    @error('model')
        <div class="mb-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @enderror
    @error('harga')
        <div class="mb-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @enderror

    <div class="card">
        <div class="card-body">
            <div class="card-header">

            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered display" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Model</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $no += 1 }}</td>
                                <td>{{ $project->jenis }}</td>
                                <td>{{ $project->model }}</td>
                                <td>{{ $project->deskripsi }}</td>
                                <td>Rp. {{ number_format($project->harga) }}.000</td>
                                <td>
                                    <button data-bs-target="#editModal" 
                                        data-bs-toggle="modal" 
                                        onclick="editModalShow('{{ $project->proyek_uuid }}','{{ $project->jenis }}','{{ $project->model }}','{{ $project->deskripsi }}','{{ $project->harga }}')" 
                                        class="btn btn-sm btn-success" ><i class="fas fa-pencil-square"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/project/setting/add" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input type="text" name="jenis" id="jenisProyek" class="form-control" placeholder="Jenis Proyek">
                            <label for="jenisProyek">Jenis Proyek</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" name="model" id="modelProyek" class="form-control" placeholder="Model Proyek">
                            <label for="modelProyek">Model Proyek</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" name="deskripsi" id="deskripsiProyek" placeholder="Proyek ini .........." class="form-control">
                            <label for="deskripsiProyek">Deskripsi</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="number" name="harga" id="hargaProyek" class="form-control" placeholder="500">
                            <label for="hargaProyek">Harga (Rp. )</label>
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
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/project/setting/" method="post" id="editForm">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input type="text" name="jenis" id="editJenisProyek" class="form-control" placeholder="Jenis Proyek">
                            <label for="jenisProyek">Jenis Proyek</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" name="model" id="editModelProyek" class="form-control" placeholder="Model Proyek">
                            <label for="modelProyek">Model Proyek</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" name="deskripsi" id="editDeskripsiProyek" placeholder="Proyek ini .........." class="form-control">
                            <label for="deskripsiProyek">Deskripsi</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="number" name="harga" id="editHargaProyek" class="form-control" placeholder="500">
                            <label for="hargaProyek">Harga (Rp. )</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
