<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

/******************** USERS ********************/ 
// Dashboard / Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('user.users'));
});

// Dashboard / Users / [User]
Breadcrumbs::for('user.show', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->username, route('user.users', ['type'=>'detail', 'id'=>$user->id]));
});

// Dashboard / Users / [User] / Edit
Breadcrumbs::for('user.edit', function ($trail, $user) {
    $trail->parent('user.show', $user);
    $trail->push('Edit', route('user.users', 'edit', $user->id));
});

/******************** Syndicates ********************/ 
// Dashboard / Syndicates
Breadcrumbs::for('syndicates', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Syndicates', route('user.syndicates'));
});

// Dashboard / Syndicate / [Syndicate]
Breadcrumbs::for('syndicate.show', function ($trail, $syndicate) {
    $trail->parent('syndicates');
    $trail->push($syndicate->name, route('user.syndicates', ['type'=>'detail', 'id'=>$syndicate->id]));
});

// Dashboard / Syndicates / [Syndicate] / Edit
Breadcrumbs::for('syndicate.edit', function ($trail, $syndicate) {
    $trail->parent('syndicate.show', $syndicate);
    $trail->push('Edit', route('user.syndicates', 'edit', $syndicate->id));
});


/******************** Residents ********************/ 
// Dashboard / Syndicate / [Syndicates] / Residents
Breadcrumbs::for('residents', function ($trail, $syndicate) {
    $trail->parent('syndicate.show', $syndicate);
    $trail->push('Residents', route('user.syndicate.residents',['syndicate_id'=>$syndicate->id]));
});

// Dashboard / Syndicates / [Syndicate] / Residents / [Resident]
Breadcrumbs::for('resident.show', function ($trail, $syndicate, $resident) {
    $trail->parent('residents', $syndicate);
    $trail->push($resident->name, route('user.syndicate.residents',['syndicate_id'=>$syndicate->id, 'type'=>'detail','id'=>$resident->id]));
});

// Dashboard / Syndicates / [Syndicate] / Residents / [Resident] / Edit
Breadcrumbs::for('resident.edit', function ($trail,$syndicate, $resident) {
    $trail->parent('resident.show', $syndicate, $resident);
    $trail->push('Edit', route('user.syndicate.residents',['syndicate_id'=>$syndicate->id, 'type'=>'edit','id'=>$resident->id]));
});

/******************** Documents ********************/ 
// Dashboard / Syndicate / [Syndicates] / documents
Breadcrumbs::for('documents', function ($trail, $syndicate) {
    $trail->parent('syndicate.show', $syndicate);
    $trail->push('Documents', route('user.syndicate.documents',['syndicate_id'=>$syndicate->id]));
});

// Dashboard / Syndicates / [Syndicate] / Documents / [Document]
Breadcrumbs::for('document.show', function ($trail, $syndicate, $document) {
    $trail->parent('documents', $syndicate);
    $trail->push($document->name, route('user.syndicate.documents',['syndicate_id'=>$syndicate->id, 'type'=>'detail','id'=>$document->id]));
});

// Dashboard / Syndicates / [Syndicate] / Documents / [Document] / Edit
Breadcrumbs::for('document.edit', function ($trail,$syndicate, $document) {
    $trail->parent('document.show', $syndicate, $document);
    $trail->push('Edit', route('user.syndicate.documents',['syndicate_id'=>$syndicate->id, 'type'=>'edit','id'=>$document->id]));
});

/******************** Fees ********************/ 
// Dashboard / Syndicate / [Syndicates] / Fees
Breadcrumbs::for('fees', function ($trail, $syndicate) {
    $trail->parent('syndicate.show', $syndicate);
    $trail->push('Fees', route('user.syndicate.fees',['syndicate_id'=>$syndicate->id]));
});

// Dashboard / Syndicates / [Syndicate] / Fees / [Fee]
Breadcrumbs::for('fee.show', function ($trail, $syndicate, $fee) {
    $trail->parent('fees', $syndicate);
    $trail->push($fee->id, route('user.syndicate.fees',['syndicate_id'=>$syndicate->id, 'type'=>'detail','id'=>$fee->id]));
});

// // Dashboard / Syndicates / [Syndicate] / Fees / [Fee] / Edit
Breadcrumbs::for('fee.edit', function ($trail,$syndicate, $fee) {
    $trail->parent('fee.show', $syndicate, $fee);
    $trail->push('Edit', route('user.syndicate.fees',['syndicate_id'=>$syndicate->id, 'type'=>'edit','id'=>$fee->id]));
});


/******************** Bank Accounts ********************/ 
// Dashboard / Bank Accounts
Breadcrumbs::for('bankAccounts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Bank Accounts', route('user.accounts'));
});

// Dashboard / Bank Accounts / [Account]
Breadcrumbs::for('bankAccount.show', function ($trail, $account) {
    $trail->parent('bankAccounts');
    $trail->push($account->name, route('user.accounts', ['type'=>'detail', 'id'=>$account->id]));
});

// Dashboard / Bank Accounts / [Account] / Edit
Breadcrumbs::for('bankAccount.edit', function ($trail, $account) {
    $trail->parent('bankAccount.show', $account);
    $trail->push('Edit', route('user.accounts', 'edit', $account->id));
});

/******************** Charges ********************/ 
// Dashboard / Charges
Breadcrumbs::for('Charges', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Charges', route('user.charges'));
});

// Dashboard / Charges / [Charge]
Breadcrumbs::for('Charges.show', function ($trail, $charge) {
    $trail->parent('Charges');
    $trail->push($charge->id, route('user.charges', ['type'=>'detail', 'id'=>$charge->id]));
});

// Dashboard / Charges / [charge] / Edit
Breadcrumbs::for('Charges.edit', function ($trail, $charge) {
    $trail->parent('Charges.show', $charge);
    $trail->push('Edit', route('user.charges', 'edit', $charge->id));
});

/******************** Cashes ********************/ 
// Dashboard / Cashes
Breadcrumbs::for('Cashes', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Cashes', route('user.cashes'));
});

// Dashboard / Cashes / [cash]
Breadcrumbs::for('Cashes.show', function ($trail, $cash) {
    $trail->parent('Cashes');
    $trail->push($cash->id, route('user.cashes', ['type'=>'detail', 'id'=>$cash->id]));
});

// Dashboard / Cashes / [cash] / Edit
Breadcrumbs::for('Cashes.edit', function ($trail, $cash) {
    $trail->parent('Cashes.show', $cash);
    $trail->push('Edit', route('user.cashes', 'edit', $cash->id));
});

/******************** Company Charges ********************/ 
// Dashboard / Company Charges
Breadcrumbs::for('companyCharges', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Company Charges', route('user.company.charges'));
});

// Dashboard / Company Charges / [companyCharge]
Breadcrumbs::for('companyCharges.show', function ($trail, $companyCharges) {
    $trail->parent('companyCharges');
    $trail->push($companyCharges->id, route('user.company.charges', ['type'=>'detail', 'id'=>$companyCharges->id]));
});

// Dashboard / Company Charges / [companyCharge] / Edit
Breadcrumbs::for('companyCharges.edit', function ($trail, $companyCharges) {
    $trail->parent('companyCharges.show', $companyCharges);
    $trail->push('Edit', route('user.company.charges', 'edit', $companyCharges->id));
});

/******************** History Logs ********************/ 
// Dashboard / History Log
Breadcrumbs::for('historyLog', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('History Log', route('user.logs'));
});