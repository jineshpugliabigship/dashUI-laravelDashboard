@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.mastercourierrates.index') }}">Mastercourierratess</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Mastercourierrates</li>
        </ol>
        <h5 class="font-weight-bolder mb-0">Mastercourierrates Management</h5>
    </nav>
@stop

@section('content')
    <div class="row my-4">
        <div class="col-lg-5">
            <div class="card h-auto">
                <div class="card-header pb-0">
                    <h6>Edit Mastercourierrates</h6>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="{{ route('admin.mastercourierrates.update', $mastercourierrates->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group">
                                <label for="name" class="form-control-label">{{ __('Mastercourierrates') }}</label>
                                <div class="@error('name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="rate Card Name" value="{{ $mastercourierrates->name }}" id="name" name="name">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-success btn-md mt-4 mb-4"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;{{ 'Edit Mastercourierrates' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
