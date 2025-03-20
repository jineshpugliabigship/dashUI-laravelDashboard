@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="{{ route('admin.mastercourierrates.index') }}">Rate Card List</a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload Rates Card</li>
        </ol>
        <h5 class="font-weight-bolder mb-0">Master Courier Rate Import</h5>
    </nav>
@stop

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h5 class="mb-0">{{ __('Upload Rate Card') }}</h5>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('admin.mastercourierrates.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $message)
                                    <li><span class="alert-text">{{ $message }}</span></li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file_upload" class="form-control-label">{{ __('CSV Upload') }}</label>
                                <div class="@error('file_upload') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="file" id="file_upload" name="file_upload" accept=".csv,.xlsx">
                                    @error('file_upload')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ __('Upload Rate Card') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
