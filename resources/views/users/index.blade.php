@extends('layouts.app')

@section('title','Users')

@section('content')

@include('layouts.navbar')

<h1>Halaman Users</h1>
<a href" class="btn btn-primary">Create</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Role</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>1</td>
        <td>bintang</td>
        <td>widhi@gmail.com</td>
        <td>admin</td>
        <td>
            <a href="" class="btn btn-sm btn-warning">
                Edit Akun
            </a>
            ||
            <form action="" method="" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
  </tbody>
</table>

@endsection