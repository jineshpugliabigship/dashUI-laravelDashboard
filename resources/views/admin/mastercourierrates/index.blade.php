@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.dashboard') }}">Home</a></li>
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
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6></h6>
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('admin.mastercourierrates.create') }}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Import CSV</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Since</th> --}}
                                
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">MasterCourierPackageId</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">MasterRateTypeId</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">MasterCourierShipmentType</th>
                                
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone A</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone B</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone C</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone D</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone E</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone F</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone G</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone H</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone I</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone J</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone K</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone L</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone M</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone N</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone O</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone P</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone Q</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone R</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone S</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone T</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone U</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone V</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone W</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone X</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone Y</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zone Z</th>
                                
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created At</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated At</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deleted At</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                @foreach($masterCourierRates as $user)
                                <tr>
                           
                          
                                    
                                    <td class="text-secondary text-xs font-weight-bold">{{ $user->MasterCourierPackageId }}</td>
                                    <td class="text-secondary text-xs font-weight-bold">{{ $user->MasterRateTypeId }}</td>
                                    <td class="text-secondary text-xs font-weight-bold">{{ $user->MasterCourierShipmentType }}</td>
                                    
                                    @foreach(range('A', 'Z') as $zone)
                                        <td class="text-secondary text-xs font-weight-bold">{{ $user['zone_'.$zone] ?? 'N/A' }}</td>
                                    @endforeach
                                    
                                    <td class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</td>
                                    <td class="text-secondary text-xs font-weight-bold">{{ $user->updated_at }}</td>
                                    <td class="text-secondary text-xs font-weight-bold">{{ $user->deleted_at ?? 'N/A' }}</td>
                                    
                                    {{-- <td class="align-middle">
                                        @foreach($user->roles as $role)
                                            @if(auth()->user()->id != $user->id)
                                            <form id="userDelete" action="{{ route('admin.mastercourierrates.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                @can('User edit')
                                                <a href="{{ route('admin.mastercourierrates.edit', $user->id) }}" @if(auth()->user()->hasRole($role->name)) hidden @endif class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                @endcan
                                                @can('User delete')
                                                    <button class="cursor-pointer fas fa-trash text-secondary" style="border: none; background: no-repeat;" data-bs-toggle="tooltip" @if(auth()->user()->hasRole($role->name)) hidden @endif data-bs-original-title="Delete User"></button>
                                                @endcan
                                            </form>
                                            @endif
                                        @endforeach
                                    </td> --}}
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
