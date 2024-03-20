@extends('Template.sidebar')
@section('title','Users')
@section('content')
<h1 class="mt-4">Users</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Pengguna</li>
</ol>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" >#</th>
                        <th scope="col" >Name</th>
                        <th scope="col" >Email</th>
                        <th scope="col" >Hak Akses</th>
                        <th scope="col" >Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" >
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $no+=1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email}}</td>
                            <td><span class="badge text-bg-primary">{{ $user->level }}</span></td>
                            <td>
                                <a href="/admin/users/{{ $user->user_uuid }}" class="btn btn-sm btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection