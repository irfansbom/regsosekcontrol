@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">BOX {{ $box->nama }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Box</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('box_besar') }}">List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $box->nama }}</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">

                    <div class="col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">SLS Dalam Box</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card shadow-none border">
                                            <div class="card-body">
                                                <form action="{{ url('box_besar') . '/' . $box->id }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <select multiple="multiple" name="id_sls[]">
                                                        @foreach ($data as $dt)
                                                            <option value="{{ $dt->id }}"
                                                                @if ($dt->no_box == $box->id) selected @endif>
                                                                <pre>
                                                                {{ $dt->id_sls }} - {{ $dt->kues }} - {{ $dt->set }} -
                                                                @isset($dt->box)
{{ $dt->box->nama }}
@endisset
                                                                </pre>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary">Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            $(document).ready(function() {
                var demo1 = $('select[name="id_sls[]"]').bootstrapDualListbox({
                    nonSelectedListLabel: 'List Dokumen',
                    selectedListLabel: 'Dokument Terpilih',
                    // preserveSelectionOnMove: 'moved',
                    // moveOnSelect: false
                });
            });
        </script>
    @endsection
