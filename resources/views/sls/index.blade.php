@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">SLS</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SLS</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">List SLS</h3>
                                <div class="ms-auto pageheader-btn">
                                    {{-- <a class="btn btn-primary btn-icon text-white me-2" href="{{ url('users/create') }}"
                                        data-bs-target="#modal_tambah">
                                        <span>
                                            <i class="fe fe-plus"></i>
                                        </span> Tambah
                                    </a> --}}
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
                                    <table class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                        <thead>
                                            <tr class="text-center align-middle">
                                                <th class="text-center align-middle" rowspan="3">No</th>
                                                <th class="text-center align-middle" rowspan="3">ID SLS</th>
                                                <th class="text-center align-middle" rowspan="3">Nama SLS</th>
                                                <th class="text-center align-middle" colspan="6">Jml Penerimaan (Set)
                                                </th>
                                            </tr>
                                            <tr class="text-center align-middle">
                                                <th colspan="3">Kab/Kota</th>
                                                <th colspan="3">Provinsi</th>
                                            </tr>
                                            <tr class="text-center align-middle">
                                                <th>K</th>
                                                <th>XK</th>
                                                <th>VK</th>
                                                <th>K</th>
                                                <th>XK</th>
                                                <th>VK</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($data as $key => $dt)
                                                <tr class="align-middle">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="align-middle">
                                                        {{ $dt->id_sls }}
                                                    </td>
                                                    <td class="align-middle">{{ $dt->nama_sls }}</td>

                                                    <td class="align-middle text-center">
                                                        {{ count($dt->p_kabkot_k) }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{ count($dt->p_kabkot_xk) }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{ count($dt->p_kabkot_vk) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW-5 END -->
        </div>
        <!-- CONTAINER END -->
    </div>

    {{-- <div class="modal fade" id="modal_edit_roles">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Roles<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ url('users/roles') }}" method="post" id="edit_form_roles">
                        @csrf
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <label for="nama_user" class="form-label">Nama user</label>
                                <input type="text" class="form-control" id="user_name" name="nama" readonly>
                            </div>

                        </div>
                        Roles
                        @foreach ($data_roles as $role)
                            <div class="form-check">
                                <input class="form-check-input roles" type="checkbox" value="{{ $role->name }}"
                                    name="roles[]" id="{{ $role->name }}">
                                <label class="form-check-label" for="{{ $role->name }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach

                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit_form_roles">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="modal_hapus">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('users/delete') }}" method="post" id="form_hapus">
                        @csrf
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <label for="nama_user" class="form-label">Nama user</label>
                                <input type="text" class="form-control" id="user_name" name="nama" readonly>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_hapus">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.btn_hapus').click(function() {
            $('#modal_hapus').find('#user_id').val($(this).data("id"));
            $('#modal_hapus').find('#user_name').val($(this).data("nama"));
        })
    </script>
@endsection
