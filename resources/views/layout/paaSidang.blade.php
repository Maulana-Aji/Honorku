@extends('dashboard.dashboard')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Tables Sidang</h1>
@if (session()->has('tambah'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('tambah') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('edit') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('hapus'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('hapus') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('back'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('back') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <!--Tambah Balita modal-->
    <div class="modal fade" id="tambahBalita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sidang</h5>
            </div>
            <div class="modal-body">
                <form action="/dashboard/paa/sidang/store" method="post">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Nama Dosen</label>
                        <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="nip_dosen">
                            @foreach ($dosen as $item)
                                <option value="{{ $item->nip_dosen }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Nama Mahasiswa</label>
                        <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="nim_mhs">
                            @foreach ($mahasiswa as $item)
                                <option value="{{ $item->nim_mhs }}">{{ $item->nama_mhs }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Nama Laporan</label>
                        <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="id_laporan">
                            @foreach ($laporan as $item)
                                <option value="{{ $item->id_laporan }}">{{ $item->nama_laporan }}</option>
                            @endforeach
                        </select> 
                    </div>                   
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Waktu</label><br>
                        <input type="datetime-local" name="waktu_sidang" required="required">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Tempat</label><br>
                        <textarea name="tempat_sidang" cols="30" rows="1" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Status</label><br>
                        <input type="radio" name="status_sidang" required="required" value="1"> Sudah Dilaksanakan  <br>
                        <input type="radio" name="status_sidang" required="required" value="0"> Belum Dilaksanakan  <br>
                    </div>             
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Simpan Data">
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahBalita">Tambah</button>
                <a type="button" class="btn btn-primary" href="/dashboard/paa/sidang/rekap">Rekap Sidang</a>
            </div>
            <a type="button" class="btn btn-primary" href="/dashboard/paa/sidang/restore">Restore</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DOSEN</th>
                            <th>MAHASISWA</th>
                            <th>NAMA LAPORAN</th>
                            <th>WAKTU</th>
                            <th>TEMPAT</th>
                            <th>STATUS</th>
                            <th>BUKTI SIDANG</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sidang as $item)
                        <tr>
                            <td>{{ $item->id_sidang }}</td>
                            <td>{{ $item->nama_dosen }}</td>
                            <td>{{ $item->nama_mhs }}</td>
                            <td>{{ $item->nama_laporan }}</td>
                            <td>{{ $item->waktu_sidang }}</td>
                            <td>{{ $item->tempat_sidang }}</td>
                            <td>
                                <?php 
                                if ($item->status_sidang==1){echo "<p style='color: rgb(5, 252, 5);'>Sudah Dilaksanakan</p>";}
                                if ($item->status_sidang==0){echo "<p style='color: red;'>Belum Dilaksanakan</p>";}
                                ?>
                            </td>
                            <td>{{ $item->bukti_sidang }}</td>
                            <td>
                                <a href="/dashboard/paa/sidang/edit/{{ $item->id_sidang }}"> <i class="fas fa-pen" style="color: rgb(179, 179, 4)"></i></a> |
                                <a href="/dashboard/paa/sidang/hapus/{{ $item->id_sidang }}" onclick="return confirm('Apakah anda ingin menghapusnya?')"> <i class="fas fa-trash" style="color: red"></i></a> |
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle btn-xs" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Download
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li class="pb-1 pl-2">
                                            <form action="/dashboard/paa/sidang/download" method="post">
                                                @csrf
                                                <input type="hidden" name="file" value="{{ $item->bukti_sidang }}">
                                                <button class="btn btn-success tombol border-0 text-center" name="op">
                                                    Download
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>                                           
                        </tr>
                        @endforeach                                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection