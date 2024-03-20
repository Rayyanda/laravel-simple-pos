@extends('Template.sidebar')
@section('title', 'New Order')
@section('content')
    <h1 class="mt-4">Pesanan Baru</h1>
    <ol class="breadcrumb mb-4">

        <li class="breadcrumb-item active">New Order</li>
    </ol>
    <div class="container">
        {{-- menampilkan error validasi --}}
        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/order/store" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Pemesanan</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-floating mb-2">
                                <select name="proyek_uuid" id="proyekUuid" class="form-select">
                                    <option selected disabled>Pilih Pesanan</option>
                                    @foreach ($proyeks as $proyek)
                                        <option value="{{ $proyek->proyek_uuid }}">{{ $proyek->model }} -
                                            {{ $proyek->jenis }}</option>
                                    @endforeach
                                </select>
                                <label for="proyekUuid">Pilih Pesanan</label>
                            </div>
                            @error('proyek_uuid')
                                <small class="text-danger m-1">{{ $message }}</small>
                            @enderror
                            <div class="form-floating mb-2">
                                <textarea name="deskripsi" id="catatan" placeholder="Catatan" cols="20" rows="5" class="form-control"></textarea>
                                <label for="catatan">Catatan</label>
                            </div>
                            @error('deskripsi')
                                <small class="text-danger m-1">{{ $message }}</small>
                            @enderror
                            <div class="form-floating mb-2">
                                <input type="date" name="tgl_mulai" class="form-control" id="tglMulai">
                                <label for="tglMulai">Tanggal Pesanan</label>
                            </div>
                            @error('tgl_mulai')
                                <small class="text-danger m-1">{{ $message }}</small>
                            @enderror
                            <div class="form-floating mb-2">
                                <input type="date" name="tgl_selesai" id="tglSelesai" class="form-control">
                                <label for="tglMulai">Tenggat</label>
                            </div>
                            @error('tgl_selesai')
                                <small class="text-danger m-1">{{ $message }}</small>
                            @enderror
                            <div class="form-floating mb-2">
                                <select name="metode_pembayaran" id="metodePembayaran" class="form-select">
                                    <option selected disabled value="">Metode Pembayaran</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cash on delivery">Cash On Delivery (COD)</option>
                                </select>
                                <label for="metodePembayaran">Pilih Metode Pembayaran</label>
                            </div>
                            @error('metode_pembayaran')
                                <small class="text-danger m-1">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Pemesan</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-2 row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input type="text" name="firstname" class="form-control" id="firstName">
                                        <label for="firstName">Nama Depan</label>
                                    </div>
                                    @error('firstname')
                                        <small class="text-danger m-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input type="text" name="lastname" id="lastName" class="form-control">
                                        <label for="lastName">Nama Belakang</label>
                                    </div>
                                    @error('lastname')
                                        <small class="text-danger m-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-floating mb-2">
                                <textarea name="alamat" id="alamatCustomer" class="form-control" cols="20" rows="5"></textarea>
                                <label for="alamatCustomer">Alamat</label>
                            </div>
                            @error('alamat')
                                <small class="text-danger m-1">{{ $message }}</small>
                            @enderror
                            <div class="form-floating mb-2">
                                <input type="text" name="email" id="emailCustomer" class="form-control">
                                <label for="emailCustomer">Email Customer</label>
                            </div>
                            @error('email')
                                <small class="text-danger m-1">{{ $message }}</small>
                            @enderror
                            <div class="form-floating mb-2">
                                <input type="text" name="no_telp" id="noTelpCustomer" class="form-control">
                                <label for="noTelpCustomer">No. Telp</label>
                            </div>
                            @error('no_telp')
                                <small class="text-danger m-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="/order" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
