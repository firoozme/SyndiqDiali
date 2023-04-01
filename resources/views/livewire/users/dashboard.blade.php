<div class="row">
    <!-- Users -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-8">
                        <h4 class="text-white">{{ $usersCount }}</h4>
                        <h6 class="text-white m-b-0">Users</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><a href="{{ route('user.users') }}" class="text-white">View All Users</a></p>
            </div>
        </div>
    </div>
    
    <!-- Syndicates -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-8">
                        <h4 class="text-white">{{ $syndicatesCount }}</h4>
                        <h6 class="text-white m-b-0">Syndicates</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="far fa-users-class fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><a href="{{ route('user.syndicates') }}" class="text-white">View All Syndicates</a></p>
            </div>
        </div>
    </div>

    <!-- Residents -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info update-card" style="background: #804674 !important;">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-8">
                        <h4 class="text-white">{{ $residentsCount }}</h4>
                        <h6 class="text-white m-b-0">Residents</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="far fa-house-return fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><a href="{{ route('user.syndicates') }}" class="text-white">View All Residents</a></p>
            </div>
        </div>
    </div>

    <!-- Documents -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-8">
                        <h4 class="text-white">{{ $documentsCount }}</h4>
                        <h6 class="text-white m-b-0">Documents</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="far fa-copy fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><a href="{{ route('user.syndicates') }}" class="text-white">View All Documents</a></p>
            </div>
        </div>
    </div>

    <!-- Fees -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-8">
                        <h4 class="text-white">{{ $feesCount }}</h4>
                        <h6 class="text-white m-b-0">Fees</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="far fa-hand-holding-usd fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><a href="{{ route('user.syndicates') }}" class="text-white">View All Fees</a></p>
            </div>
        </div>
    </div>

    <!-- Charges -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-8">
                        <h4 class="text-white">{{ $chargesCount }}</h4>
                        <h6 class="text-white m-b-0">Charges</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fal fa-file-invoice-dollar fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><a href="{{ route('user.charges') }}" class="text-white">View All Charges</a></p>
            </div>
        </div>
    </div>
    
    <!-- Cashes -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-lite-green update-card" style="background: #A86464 !important;">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-8">
                        <h4 class="text-white">{{ $cashesCount }}</h4>
                        <h6 class="text-white m-b-0">Cashes</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fal fa-cash-register fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><a href="{{ route('user.cashes') }}" class="text-white">View All Cashes</a></p>
            </div>
        </div>
    </div>

    <!-- Company Charges -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-8">
                        <h4 class="text-white">{{ $companyChargesCount }}</h4>
                        <h6 class="text-white m-b-0">Company Charges</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fal fa-building fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><a href="{{ route('user.company.charges') }}" class="text-white">View All Company Charges</a></p>
            </div>
        </div>
    </div>
    

    <div class="col-xl-8 col-md-12">
        <div class="card table-card">
            <div class="card-header">
                <h5>Latest Residents</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="far fa-expand full-card"></i></li>
                        <li><i class="far fa-minus minimize-card"></i></li>
                        <li><i class="far fa-trash close-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover  table-borderless">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CIN</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Syndicate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($residents as $resident)
                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <h6>{{ $resident->name }}</h6>
                                        <p class="text-muted m-b-0">{{ $resident->created_at->diffForHumans() }}</p>
                                    </div>
                                </td>
                                <td>{{ $resident->cin }}</td>
                                <td>{{ $resident->phone }}</td>
                                <td class="text-c-blue">{{ \Illuminate\Support\Str::limit($resident->address, 100, $end='...') }}</td>
                                <td>{{ $resident->syndicate->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No Resident</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card user-activity-card">
            <div class="card-header">
                <h5>User Activity</h5>
            </div>
            <div class="card-block">
                @forelse ($logs as $log)
                    <div class="row m-b-25">
                        <div class="col">
                            <h6 class="m-b-5">{{ $log->username }}</h6>
                            <p class="text-muted m-b-0">{{ $log->description }}</p>
                            <p class="text-muted m-b-0"><i class="far fa-clock m-r-10"></i>{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                   
                @empty
                    <div class="row m-b-25">
                    <div class="col text-center">
                        No Log
                    </div>
                </div>
                @endforelse

                @if ($logs->count())
                <div class="text-center">
                    <a href="{{ route('user.logs') }}" class="b-b-primary text-primary">View all Activities</a>
                </div>
                    
                @endif
               
            </div>
        </div>
    </div>

    
    

    @section('title')
        Dashboard
    @endsection
</div>