@extends('Template.sidebar')
@section('title','Order')
@section('content')
<h1 class="mt-4">Order</h1>
<ol class="breadcrumb mb-4">
    
    <li class="breadcrumb-item active">Order</li>
</ol>
<div class="card shadow mb-2">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" >#</th>
                        <th scope="col" >ID Pesanan</th>
                        <th scope="col" >Nama Customer</th>
                        <th scope="col" >Email</th>
                        <th scope="col" >Pesanan</th>
                        <th scope="col" >Tenggat</th>
                        <th scope="col" >Catatan</th>
                        <th scope="col" >Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" >
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $no+=1 }}</td>
                            <td>{{ substr($order->uuid_list,0,10) }}***</td>
                            <td>{{ $order->firstname }}  {{  $order->lastname }}</td>
                            <td>{{ $order->email}}</td>
                            <td>{{ $order->jenis }} - {{ $order->model }}</td>
                            <td>{{ $order->tgl_selesai }}</td>
                            <td>{{ substr($order->deskripsi,0,5) }}...</td>
                            <td>
                                <a href="/order/{{ $order->uuid_list }}/detail" class="btn btn-sm btn-warning m-1"><i class="fa-solid fa-circle-info"></i></a>
                                <a href="/order/e/{{ $order->uuid_list }}" class="btn btn-sm btn-success m-1"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection