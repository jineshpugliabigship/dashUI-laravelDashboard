@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Users</li>
        </ol>
        <h5 class="font-weight-bolder mb-0">Master Courier Rates</h5>
    </nav>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h6>Master Courier Rates</h6>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('admin.mastercourierrates.index') }}">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('admin.mastercourierrates.export') }}">
                                <i class="fas fa-download"></i>&nbsp;&nbsp;Download CSV
                            </a>
                        </div>
                        <div class="col-md-2 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('admin.mastercourierrates.create') }}">
                                <i class="fas fa-plus"></i>&nbsp;&nbsp;Import CSV
                            </a>
                        </div>
                
                        
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">MasterCourierPackageId</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">MasterRateTypeId</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">MasterCourierShipmentType</th>
                                    @foreach(range('A', 'Z') as $zone)
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone {{ $zone }}</th>
                                    @endforeach
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created At</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated At</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deleted At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($masterCourierRates as $rate)
                                    <tr>
                                        <td class="text-secondary text-xs font-weight-bold">{{ $rate->MasterCourierPackageId }}</td>
                                        <td class="text-secondary text-xs font-weight-bold">{{ $rate->MasterRateTypeId }}</td>
                                        <td class="text-secondary text-xs font-weight-bold">{{ $rate->MasterCourierShipmentType }}</td>
                                        @foreach(range('A', 'Z') as $zone)
                                            <td class="text-secondary text-xs font-weight-bold">{{ $rate['zone_'.$zone] ?? 'N/A' }}</td>
                                        @endforeach
                                        <td class="text-secondary text-xs font-weight-bold">{{ $rate->created_at }}</td>
                                        <td class="text-secondary text-xs font-weight-bold">{{ $rate->updated_at }}</td>
                                        <td class="text-secondary text-xs font-weight-bold">{{ $rate->deleted_at ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-3">
                            {!! $masterCourierRates->appends(request()->query())->links('vendor.pagination.bootstrap-4') !!}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
