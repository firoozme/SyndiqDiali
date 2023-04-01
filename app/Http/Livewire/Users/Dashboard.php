<?php

namespace App\Http\Livewire\Users;

use App\Models\Fee;
use App\Models\Cash;
use App\Models\User;
use App\Models\Charge;
use Livewire\Component;
use App\Models\Document;
use App\Models\Resident;
use App\Models\Syndicate;
use App\Models\HistoryLog;
use App\Models\CompanyCharge;

class Dashboard extends Component
{
    public $residents;
    public $logs;
    public $usersCount, $syndicatesCount, $feesCount, $residentsCount, $documentsCount, $chargesCount, $cashesCount, $companyChargesCount;
    public function mount()
    {
        $this->residents = Resident::latest()->limit(4)->get();
        $this->logs = HistoryLog::latest()->limit(4)->get();
        $this->usersCount = User::count();
        $this->residentsCount = Resident::count();
        $this->documentsCount = Document::count();
        $this->syndicatesCount = Syndicate::count();
        $this->chargesCount = Charge::count();
        $this->cashesCount = Cash::count();
        $this->feesCount = Fee::count();
        $this->companyChargesCount = CompanyCharge::count();
    }
    public function render()
    {
        return view('livewire.users.dashboard')->extends('layouts.user.app')->section('content');
    }
}
