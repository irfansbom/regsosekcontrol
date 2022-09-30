@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Kuesioner</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Kuesioner</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">List Kuesioner</h3>
                                <div class="ms-auto pageheader-btn">
                                    @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI'])
                                        <button class="btn btn-primary btn-icon text-white me-2" data-bs-toggle="modal"
                                            data-bs-target="#modal_tambah">
                                            <span>
                                                <i class="fe fe-plus"></i>
                                            </span> Tambah
                                        </button>
                                    @endhasanyrole
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                        <thead>
                                            <tr class="text-center align-middle">
                                                <th class="text-center align-middle">No</th>
                                                <th class="text-center align-middle">Kuesioner</th>
                                                <th class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($data as $key => $dt)
                                                <tr class="align-middle">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="align-middle">
                                                        {{ $dt->nama }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI'])
                                                            <button class="btn btn-outline-warning btn-sm btn_edit"
                                                                data-bs-toggle="modal" data-bs-target="#modal_edit"
                                                                data-id="{{ $dt->id }}" data-nama="{{ $dt->nama }}">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <button class="btn btn-outline-danger btn-sm btn_hapus"
                                                                data-bs-toggle="modal" data-bs-target="#modal_hapus"
                                                                data-id="{{ $dt->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endhasanyrole
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_hapus">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Kuesioner<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_hapus">
                        @csrf
                        @method('delete')
                        <div class="row ">
                            Hapus Jenis Kuesioner ini?
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_hapus">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kuesioner<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_edit">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Jenis Kuesioner</label>
                                    <input type="text" class="form-control" name="nama" id="modal_edit_nama" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_edit">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kuesioner<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('kues') }}" method="post" id="form_tambah">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Jenis Kuesioner</label>
                                    <input type="text" class="form-control" name="nama" id="modal_tambah_nama"
                                        required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_tambah">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
        $('.btn_hapus').click(function() {
            $('#modal_hapus').find('#form_hapus').attr('action', APP_URL + '/kues/' + $(this).data('id'));
        })

        $('.btn_edit').click(function() {
            $('#modal_edit').find('#form_edit').attr('action', APP_URL + '/kues/' + $(this).data('id'));
            $('#modal_edit').find('#modal_edit_nama').val($(this).data('nama'));
        })
    </script>
@endsection
