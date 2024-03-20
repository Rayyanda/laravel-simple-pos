@extends('Template.sidebar')
@section('title','Customer')
@section('content')
<h1 class="mt-4">Customer</h1>
<ol class="breadcrumb mb-4">
    
    <li class="breadcrumb-item active">Pelanggan</li>
</ol>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" >#</th>
                        <th scope="col" >Nama</th>
                        <th scope="col" >Email</th>
                        <th scope="col" >Alamat</th>
                        <th scope="col" >No. Telp</th>
                        <th scope="col" >Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" >
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $no+=1 }}</td>
                            <td>{{ $customer->firstname }}  {{  $customer->lastname }}</td>
                            <td>{{ $customer->email}}</td>
                            <td>
                                {{ $customer->alamat }}
                            </td>
                            <td>{{ $customer->no_telp }}</td>
                            <td>
                                <a href="/customer/{{ $customer->customer_uuid }}" class="btn btn-sm btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection