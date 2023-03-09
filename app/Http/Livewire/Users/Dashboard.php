<?php

namespace App\Http\Livewire\Users;

use App\Models\Fee;
use App\Models\User;
use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;
use App\Models\HistoryLog;

class Dashboard extends Component
{
    public $residents;
    public $logs;
    public $usersCount, $residentsCount, $syndicatesCount, $feesCount;
    public function mount()
    {
        $this->residents = Resident::latest()->limit(4)->get();
        $this->logs = HistoryLog::latest()->limit(4)->get();
        $this->usersCount = User::count();
        $this->residentsCount = Resident::count();
        $this->syndicatesCount = Syndicate::count();
        $this->feesCount = Fee::count();
    }
    public function render()
    {
        return view('livewire.users.dashboard')->extends('layouts.user.app')->section('content');
    }
}
