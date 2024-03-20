@extends('Template.sidebar')
@section('title','Settings')
@section('content')
<h1 class="mt-4">Proyek</h1>
<ol class="breadcrumb mb-4">
    <a href="/project/setting" class="breadcrumb-item">Pengaturan Proyek</a>
    <li class="breadcrumb-item active">New</li>
</ol>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" >#</th>
                        <th scope="col" >Jenis</th>
                        <th scope="col" >Model</th>
                        <th scope="col" >Harga</th>
                        <th scope="col" >Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" >
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $no+=1 }}</td>
                            <td>{{ $project->jenis }}</td>
                            <td>{{ $project->model}}</td>
                            <td>{{ $project->harga }}</td>
                            <td>
                                <a href="/proje/users/{{ $user->user_uuid }}" class="btn btn-sm btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection