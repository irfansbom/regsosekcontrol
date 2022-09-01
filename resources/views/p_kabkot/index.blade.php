@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Penerimaan Kabkot</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Penerimaan Kabkot</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card ">
                                <div class="card-header border-0 pb-0">
                                    <h3 class="card-title mb-0">List DS BS</h3>
                                    <div class="ms-auto pageheader-btn">
                                        @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'])
                                            <div class="btn-group mt-2 mb-2">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#modal_tambah">Tambah Dokumen Diterima</button>
                                            </div>
                                        @endhasanyrole
                                    </div>
                                </div>
                                <div class="card-header pt-0 d-flex justify-content-center">
                                    <div class="row col">
                                        <div class="alert alert-info" role="alert">
                                            List Dibawah ini merupakan satu set dokumen per kuesionernya yang telah diterima
                                            BPS Kabkot dari hasil pendataan lapangan </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <form action="" id="form_filter">
                                                <fieldset>
                                                    <div class="mb-1 row">
                                                        {{-- <label for="kab_filter" class="col-sm-2 col-form-label">Kab/Kot</label> --}}
                                                        <div class="col-sm-3">
                                                            <select name="kab_filter" id="kab_filter"
                                                                class="form-control select2-show-search form-select">
                                                                <option value="">Pilih Kab/Kot</option>
                                                                <option value=""> [00]
                                                                    PROVINSI SUMSEL</option>
                                                                @foreach ($kabs as $kab)
                                                                    <option value="{{ $kab->id_kab }}"
                                                                        @if ($kab->id_kab == $request->kab_filter) selected @endif>
                                                                        [{{ $kab->id_kab }}]
                                                                        {{ $kab->alias }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="text" name="sls_filter" id="sls_filter"
                                                                placeholder="cari ID SLS" class="form-control"
                                                                @if ($request->sls_filter) value="{{ $request->sls_filter }}" @endif>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="submit" class="btn btn-primary">Cari</button>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table
                                            class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                            <thead>
                                                <tr class="text-center align-middle">
                                                    <th class="text-center align-middle">No</th>
                                                    <th class="text-center align-middle">ID SLS</th>
                                                    <th class="text-center align-middle">Tipe Dok</th>
                                                    <th class="text-center align-middle">Set </th>
                                                    <th class="text-center align-middle">Box </th>
                                                    <th class="text-center align-middle">Surat </th>
                                                    <th class="text-center align-middle">Status</th>
                                                    <th class="text-center align-middle">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                @foreach ($data as $key => $dt)
                                                    <tr class="align-middle">
                                                        <td class="text-center align-middle"
                                                            rowspan="{{ count($dt->dok) }}">
                                                            {{ ++$key }}</td>
                                                        <td class="align-middle" rowspan="{{ count($dt->dok) }}">
                                                            {{ $dt['id_sls'] }}
                                                        </td>
                                                        <td>{{ $dt->dok[0]['kues'] }}</td>
                                                        <td>{{ $dt->dok[0]['set'] }}</td>
                                                        <td>{{ $dt->dok[0]['no_box'] }}</td>
                                                        <td>{{ $dt->dok[0]['no_surat'] }}</td>
                                                        <td>{{ $dt->dok[0]['status'] }}</td>
                                                        <td>
                                                            <button class="btn btn-outline-warning btn-sm btn_edit"
                                                                data-bs-toggle="modal" data-bs-target="#modal_edit"
                                                                data-id="{{ $dt->dok[0]['id'] }}">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <button class="btn btn-outline-danger btn-sm btn_hapus"
                                                                data-bs-toggle="modal" data-bs-target="#modal_hapus"
                                                                data-id="{{ $dt->dok[0]['id'] }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @for ($dok = 1; $dok <= count($dt->dok) - 1; $dok++)
                                                        <tr>
                                                            <td>{{ $dt->dok[$dok]['kues'] }}</td>
                                                            <td>{{ $dt->dok[$dok]['set'] }}</td>
                                                            <td>{{ $dt->dok[$dok]['no_box'] }}</td>
                                                            <td>{{ $dt->dok[$dok]['no_surat'] }}</td>
                                                            <td>{{ $dt->dok[$dok]['status'] }}</td>
                                                            <td>
                                                                <button class="btn btn-outline-warning btn-sm btn_edit"
                                                                    data-id="{{ $dt->dok[$dok]['id'] }}">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
                                                                <button class="btn btn-outline-danger btn-sm btn_hapus"
                                                                    data-bs-toggle="modal" data-bs-target="#modal_hapus"
                                                                    data-id="{{ $dt->dok[$dok]['id'] }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endfor
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $data->links() }}
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
                        <h4 class="modal-title">Hapus Dokument<span></span></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('p_kabkot/delete') }}" method="post" id="form_hapus">
                            @csrf
                            @method('delete')
                            <div class="row ">
                                <input type="text" name="id" id="hapus_id" hidden>
                                <h6>Hapus Dokumen ini?</h6>
                                {{-- <div class="mb-3 ">
                                    <label for="nama_user" class="form-label">Nama user</label>
                                    <input type="text" class="form-control" id="user_name" name="nama" readonly>
                                </div> --}}
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
        <div class="modal fade" id="modal_tambah">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Dokumen Diterima<span></span></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('p_kabkot') }}" method="post" id="form_tambah">
                            @csrf
                            <input type="text" name="id" id="tambah_id" hidden>
                            <div class="row mb-1">
                                <div class="col-3 form-group">
                                    <select name="id_kab" id="tambah_id_kab" class="select2" required>
                                        <option value="">Pilih Kabupaten</option>
                                        @foreach ($kabs as $kab)
                                            <option value="{{ $kab->id_kab }}">
                                                [{{ $kab->id_kab }}]{{ $kab->nama_kab }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 form-group">
                                    <select name="id_kec" id="tambah_id_kec" class="select2" required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                                <div class="col-3 form-group">
                                    <select name="id_desa" id="tambah_id_desa" class="select2" required>
                                        <option value="">Pilih Desa</option>
                                    </select>
                                </div>
                                <div class="col-3 form-group">
                                    <select name="id_sls" id="tambah_id_sls"
                                        class="form-control select2-show-search form-select" data-placeholder="Pilih SLS"
                                        required style="width: 100%">
                                        <option label="Pilih SLS"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-6">
                                    <label for="tambah_kues" class="form-label">Jenis Kuesioner</label>
                                    <select name="kues" id="tambah_kues"
                                        class="form-control select2-show-search form-select" required style="width: 100%">
                                        <option value="">Pilih Kuesioner</option>
                                        @foreach ($kues as $ks)
                                            <option value="{{ $ks->nama }}">{{ $ks->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="tambah_set" class="form-label">No Set</label>
                                    <input type="number" class="form-control" name="set" id="tambah_set">
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

    @section('css')
        <style>
            .select2-container--open {
                z-index: 9000;
            }

            .select2-dropdown {
                z-index: 9001;
            }
        </style>
    @endsection

    @section('script')
        <script>
            $('.btn_roles').click(function() {
                console.log($(this).data("id"))
                $('#modal_edit_roles').find('#user_id').val($(this).data("id"));
                $('#modal_edit_roles').find('#user_name').val($(this).data("nama"));
                var roles = [];
                $(this).data("roles").forEach(element => {
                    roles.push(element['name']);
                });
                $('#modal_edit_roles').find('input[name="roles[]"]').each(function() {
                    if (roles.includes(this.value)) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
            })

            $('.btn_hapus').click(function() {
                console.log($(this).data("id"))
                $('#modal_hapus').find('#hapus_id').val($(this).data("id"));
            })

            $(document).ready(function() {
                $('#tambah_id_sls, #tambah_kues').select2({
                    dropdownParent: $("#modal_tambah")
                });

                $('#tambah_id_kab').change(function() {
                    getkec();
                })
                $('#tambah_id_kec').change(function() {
                    getdesa();
                })
                $('#tambah_id_desa').change(function() {
                    getsls();
                })
            });

            function getkec() {
                $.ajax({
                        asycn: false,
                        type: "get",
                        url: "{{ url('getkec') }}",
                        data: {
                            "id_kab": $('#tambah_id_kab').val()
                        }
                    })
                    .done(function(res) {
                        $('#tambah_id_kec').html('<option value="">Kecamatan</option>');
                        res.kec.forEach(element => {
                            var option_kec = '<option value="' + element.id_kec + '" > [' + element.id_kec + ']  ' +
                                element.nama_kec +
                                '</option> '
                            $('#tambah_id_kec').append(option_kec);
                        })
                    });
            }

            function getdesa() {
                $.ajax({
                        asycn: false,
                        type: "get",
                        url: "{{ url('getdesa') }}",
                        data: {
                            "id_kab": $('#tambah_id_kab').val(),
                            "id_kec": $('#tambah_id_kec').val()
                        }
                    })
                    .done(function(res) {
                        $('#tambah_id_desa').html('<option value="">Desa</option>');
                        res.desa.forEach(element => {
                            var option_desa = '<option value="' + element.id_desa + '" > [' + element.id_desa +
                                ']' + element
                                .nama_desa +
                                '</option> '
                            $('#tambah_id_desa').append(option_desa);
                        })
                    });
            }

            function getsls() {
                $.ajax({
                        asycn: false,
                        type: "get",
                        url: "{{ url('getsls') }}",
                        data: {
                            "id_kab": $('#tambah_id_kab').val(),
                            "id_kec": $('#tambah_id_kec').val(),
                            "id_desa": $('#tambah_id_desa').val(),
                        }
                    })
                    .done(function(res) {
                        $('#tambah_id_sls').html('<option value="">SLS</option>');
                        res.sls.forEach(element => {
                            var option_sls = '<option value="' + element.id_sls + '" >' + element.id_sls +
                                '</option> '
                            $('#tambah_id_sls').append(option_sls);
                        })
                    });
            }
        </script>
    @endsection
