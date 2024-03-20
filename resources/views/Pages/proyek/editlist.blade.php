@extends('Template.sidebar')
@section('title','Edit Order')
@section('content')
<h1 class="mt-4">Order</h1>
<ol class="breadcrumb mb-4">
    <a href="/order" class="breadcrumb-item">Order</a>
    <li class="breadcrumb-item active">Edit Order</li>
</ol>
<div class="card shadow mb-2">
    <div class="card-header">
        <h2><i class="fa-solid fa-circle-info"></i> Data Pesanan</h2>
    </div>
    <div class="card-body">
        <form action="/order/update/{{ $details->uuid_list }}" method="post">
            @csrf
            <div class="row mb-2">
                <label for="orderId" class="col-sm-2 col-form-label">Order ID</label>
                <div class="col-sm-10">
                    <input type="text"  value="{{ $details->uuid_list }}" name="order_id" id="orderId" readonly class=" form-control-plaintext">
                </div>
            </div>
            <div class="row mb-2">
                <label for="namaPemesan" class="col-sm-2 col-form-label">Nama Pemesan</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $details->firstname }} {{ $details->lastname }}"  name="nama" id="namaPemesan" class=" form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label for="emailPemesan" class="col-sm-2 col-form-label">Email Pemesan</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $details->email }}" name="email" id="emailPemesan"  class=" form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label for="noTelpPemesan" class="col-sm-2 col-form-label">No. Telp Pemesan</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $details->no_telp }}" name="no_telp" id="noTelpPemesan"  class=" form-control">
                </div>
            </div>
            
            <div class="row mb-2">
                <label for="jenisProyek" class="col-sm-2 col-form-label">Jenis Pesanan</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $details->jenis }}"  name="jenisPesanan" id="jenisProyek" class=" form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label for="modelPesanan" class="col-sm-2 col-form-label">Model</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $details->model }}"  name="model_pesanan" id="modelPesanan" class=" form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label for="deskripsiPesanan" class="col-sm-2 col-form-label">Catatan</label>
                <div class="col-sm-10">
                    <input type="text" name="deskripsi" value="{{ $details->deskripsi }}"  id="deskripsiPesanan" class=" form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label for="tglSelesai" class="col-sm-2 col-form-label">Tenggat Waktu</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $details->tgl_selesai }}" name="tgl_selesai" id="tglSelesai"  class=" form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label for="hargaPesanan" class="col-sm-2 col-form-label">Harga (Rp)</label>
                <div class="col-sm-10">
                    <input type="number" value="{{ $details->harga }}" name="harga" id="hargaPesanan" class="form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label for="statusPembayaran" class="col-sm-2 col-form-label">Status Pembayaran</label>
                <div class="col-sm-10">
                    @if ($details->status == 1)
                    <input type="text" name="status" readonly value="Sudah DP" id="statusPesanan" class="form-control-plaintext text-success">
                    @elseif ($details->status == 2)
                    <input type="text" name="status" readonly value="Pesanan dalam proses" id="statusPesanan" class="form-control-plaintext text-secondary">
                    @elseif ($details->status == 3)
                    <input type="text" name="status" readonly value="Lunas" id="statusPesanan" class="form-control-plaintext text-primary">
                    @elseif ($details->status == 4)
                    <input type="text" name="status" readonly value="Lunas" id="statusPesanan" class="form-control-plaintext text-success">
                    @elseif ($details->status == 5)
                    <input type="text" name="status" readonly value="Lunas" id="statusPesanan" class="form-control-plaintext text-danger">
                    @else
                    <input type="text" name="status" readonly value="Pesanan belum dibayar" id="statusPesanan" class="form-control-plaintext text-warning">
                    @endif
                </div>
            </div>
            <div class="row mb-2">
                <label for="statusPesanan" class="col-sm-2 col-form-label">Status Pesanan</label>
                <div class="col-sm-10">
                    @if ($details->status == 1)
                    <input type="text" name="status" readonly value="Pesanan dalam proses" id="statusPesanan" class="form-control-plaintext text-success">
                    @elseif ($details->status == 2)
                    <input type="text" name="status" readonly value="Pesanan dalam proses" id="statusPesanan" class="form-control-plaintext text-secondary">
                    @elseif ($details->status == 3)
                    <input type="text" name="status" readonly value="Pesanan dalam proses" id="statusPesanan" class="form-control-plaintext text-primary">
                    @elseif ($details->status == 4)
                    <input type="text" name="status" readonly value="Selesai" id="statusPesanan" class="form-control-plaintext text-success">
                    @elseif ($details->status == 5)
                    <input type="text" name="status" readonly value="Dibatalkan" id="statusPesanan" class="form-control-plaintext text-danger">
                    @else
                    <input type="text" name="status" readonly value="Pesanan belum di eksekusi" id="statusPesanan" class="form-control-plaintext text-warning">
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    @if ($details->status == 1)
                    {{-- button untuk belum bayar dp --}}
                    <a href="#" class="btn btn-secondary disabled">Sudah DP</a>
                    {{-- proses pesanan 2 --}}
                    <a href="#" class="btn btn-warning">Proses Pesanan</a>
                    {{-- jadi lunas 3 --}}
                    <a href="#" class="btn btn-primary">Lunas</a>
                    {{-- tandai selesai 4 --}}
                    <a href="#" class="btn btn-success">Selesai</a>
                    {{-- dibatalkan 5 --}}
                    <a href="#" class="btn btn-danger">Batalkan Pesanan</a>
                    

                    @elseif ($details->status == 2)
                   {{-- button untuk belum bayar dp --}}
                   <a href="#" class="btn btn-secondary disabled">Sudah DP</a>
                   {{-- proses pesanan 2 --}}
                   <a href="#" class="btn btn-warning disabled">Proses Pesanan</a>
                   {{-- jadi lunas 3 --}}
                   <a href="#" class="btn btn-primary">Lunas</a>
                   {{-- tandai selesai 4 --}}
                   <a href="#" class="btn btn-success">Selesai</a>
                   {{-- dibatalkan 5 --}}
                   <a href="#" class="btn btn-danger">Batalkan Pesanan</a>
                   

                    @elseif ($details->status == 3)
                    {{-- button untuk belum bayar dp --}}
                    <a href="#" class="btn btn-secondary disabled">Sudah DP</a>
                    {{-- proses pesanan 2 --}}
                    <a href="#" class="btn btn-warning disabled">Proses Pesanan</a>
                    {{-- jadi lunas 3 --}}
                    <a href="#" class="btn btn-primary disabled">Lunas</a>
                    {{-- tandai selesai 4 --}}
                    <a href="#" class="btn btn-success">Selesai</a>
                    {{-- dibatalkan 5 --}}
                    <a href="#" class="btn btn-danger">Batalkan Pesanan</a>
                    

                    @elseif ($details->status == 4)
                    {{-- button untuk belum bayar dp --}}
                    <a href="#" class="btn btn-secondary disabled">Sudah DP</a>
                    {{-- proses pesanan 2 --}}
                    <a href="#" class="btn btn-warning disabled">Proses Pesanan</a>
                    {{-- jadi lunas 3 --}}
                    <a href="#" class="btn btn-primary disabled">Lunas</a>
                    {{-- tandai selesai 4 --}}
                    <a href="#" class="btn btn-success disabled">Selesai</a>
                    {{-- dibatalkan 5 --}}
                    <a href="#" class="btn btn-danger disabled">Batalkan Pesanan</a>

                    @elseif ($details->status == 5)
                   {{-- button untuk belum bayar dp --}}
                   <a href="#" class="btn btn-secondary disabled">Sudah DP</a>
                   {{-- proses pesanan 2 --}}
                   <a href="#" class="btn btn-warning disabled">Proses Pesanan</a>
                   {{-- jadi lunas 3 --}}
                   <a href="#" class="btn btn-primary disabled">Lunas</a>
                   {{-- tandai selesai 4 --}}
                   <a href="#" class="btn btn-success disabled">Selesai</a>
                   {{-- dibatalkan 5 --}}
                   <a href="#" class="btn btn-danger disabled">Batalkan Pesanan</a>
                   
                    @else
                    {{-- button untuk belum bayar dp --}}
                    <a href="#" class="btn btn-secondary">Sudah DP</a>
                    {{-- proses pesanan 2 --}}
                    <a href="#" class="btn btn-warning">Proses Pesanan</a>
                    {{-- jadi lunas 3 --}}
                    <a href="#" class="btn btn-primary">Lunas</a>
                    {{-- tandai selesai 4 --}}
                    <a href="#" class="btn btn-success">Selesai</a>
                    {{-- dibatalkan 5 --}}
                    <a href="#" class="btn btn-danger">Batalkan Pesanan</a>
                    
                    @endif
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection