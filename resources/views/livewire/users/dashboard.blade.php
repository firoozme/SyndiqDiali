<div class="row">
    <!-- task, page, download counter  start -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-yellow update-card">
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
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-green update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-8">
                        <h4 class="text-white">{{ $residentsCount }}</h4>
                        <h6 class="text-white m-b-0">Residents</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="far fa-2x fa-house-return"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><a href="{{ route('user.residents') }}" class="text-white">View All Residents</a></p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-pink update-card">
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
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-lite-green update-card">
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
                <p class="text-white m-b-0"><a href="{{ route('user.fees') }}" class="text-white">View All Fees</a></p>
            </div>
        </div>
    </div>
    <!-- task, page, download counter  end -->

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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($residents as $resident)
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
                            </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="text-center">
                        <a href="{{ route('user.residents') }}" class=" b-b-primary text-primary">View all Residents</a>
                    </div>
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
                @foreach ($logs as $log)
                    <div class="row m-b-25">
                        <div class="col">
                            <h6 class="m-b-5">{{ $log->username }}</h6>
                            <p class="text-muted m-b-0">{{ $log->description }}</p>
                            <p class="text-muted m-b-0"><i class="far fa-clock m-r-10"></i>{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    
                @endforeach


                <div class="text-center">
                    <a href="{{ route('user.logs') }}" class="b-b-primary text-primary">View all Activities</a>
                </div>
            </div>
        </div>
    </div>

    
    

    @section('title')
        Dashboard
    @endsection
</div>