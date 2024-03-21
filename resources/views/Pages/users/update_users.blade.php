@extends('Template.sidebar')
@section('title','Update User')
@section('content')
<h1 class="mt-4">Update User</h1>
<ol class="breadcrumb mb-4">
    <a href="/admin/users" class="breadcrumb-item">Pengguna</a>
    <li class="breadcrumb-item active">Update Pengguna</li>
</ol>
<div class="card shadow mb-2">
    <div class="card-body">
        {{-- pesan --}}
        <form action="/admin/users/save/{{ $user->user_uuid }}" method="post">
            @csrf
            <div class="row mb-2">
                <label for="userName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" value="{{ $user->name }}" id="userName" class="form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label for="emailUser" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" value="{{ $user->email }}" id="emailUser" class="form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label for="userLevel" class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-10">
                    <select name="level" id="userLevel" class="form-select">
                        <option {{ $user->level == "user" ? 'selected' : '' }} value="user">User</option>
                        <option {{ $user->level == "admin" ? 'selected' : '' }} value="admin">Administrator</option>
                        <option {{ $user->level == "guest" ? 'selected' : '' }} value="guest">Guest</option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success"> Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection