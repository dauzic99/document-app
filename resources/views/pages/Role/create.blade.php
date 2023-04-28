@extends('layouts.app.master')

@section('title', 'Tambah ' . Str::ucfirst($prefix))

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Tambah {{ $prefix }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ Str::ucfirst($prefix) }}</li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row starter-main">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Form</h5>
                    </div>

                    <form class="needs-validation" novalidate="" method="POST" action="{{ route('role.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="name-form">Nama Role</label>
                                    <input
                                        class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                                        id="name-form" type="text" value="{{ old('name') }}" required=""
                                        data-bs-original-title="" title="" name="name">
                                    {{-- <div class="valid-feedback"></div> --}}
                                    {{-- <div class="invalid-feedback">Nama Role tidak boleh kosong</div> --}}
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5>Hak Akses</h5>
                                </div>
                            </div>
                            <div class="row">
                                @forelse ($permissions as $item)
                                    <div class="col-md-6">
                                        <label class="d-block" for="permission-{{ $loop->iteration }}">
                                            <input class="checkbox_animated" id="permission-{{ $loop->iteration }}"
                                                type="checkbox" name="permissions[]" value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                @empty
                                @endforelse


                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit" data-bs-original-title=""
                                        title="">Simpan</button>
                                    <a href="{{ route($prefix . '.index') }}" class="btn btn-outline-secondary">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>

@endsection

@section('script')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                notify('Terjadi Kesalahan', 'Silahkan cek kembali inputan anda.', 'danger')
            });
        </script>
    @endif
    <script></script>

@endsection
