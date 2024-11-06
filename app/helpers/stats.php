<?php
use Carbon\Carbon;
function daysForChart($month = null, $year = null)
{
    $thisMonthDaysChart = '';
    if (is_array($month)) {
        $month = $month[0];
    }
    $thisMonthDaysCount = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    for ($i=1; $i <= $thisMonthDaysCount; $i++) {
        $thisMonthDaysChart .= $i;
        if ($i<$thisMonthDaysCount) {
            $thisMonthDaysChart .= ',';
        }
    }
    return $thisMonthDaysChart;
}

function monthsForThisYear($year = null)
{
    $monthsArray = [];
    for ($i=1; $i <= 12; $i++) {
        $thisMonth = str_pad($i, 2, '0', STR_PAD_LEFT);
        if ($year == date('Y')) {
            if ($thisMonth <= date('m')) {
                $monthsArray[] = $thisMonth;
            }
        } else {
            $monthsArray[] = $thisMonth;
        }

    }
    return $monthsArray;
}
function allMonthsArray($year = null)
{
    $StartDate = strtotime("Dec 2020");
    $StopDate = strtotime(date('M Y'));
    $current = $StartDate;
    $ret = array();

    while( $current<$StopDate ){

        $next = date('Y-M-01', $current) . "+1 month";
        $current = strtotime($next);
        $ret[] = date('Y-M-01', $current);
    }

    return array_reverse($ret);
}


function expensesForChart($branch = 'all', $month = null, $year = null)
{
    $ExpensesChart = '';
    if (is_array($month)) {
        $month = $month[0];
    }
    $thisMonthDaysCount = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    for ($i=1; $i <= $thisMonthDaysCount; $i++) {
        $day = $year.'-'.$month.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
        if ($branch == 'all') {
            $dayExpenses = App\Models\Expenses::whereNotIn('Type',['transfeerToAnother'])->where('ExpenseDate',$day)->sum('Expense');
        } else {
            $dayExpenses = App\Models\Expenses::whereNotIn('Type',['transfeerToAnother'])->where('branch_id',$branch)->where('ExpenseDate',$day)->sum('Expense');
        }
        $ExpensesChart .= $dayExpenses;
        if ($i<$thisMonthDaysCount) {
            $ExpensesChart .= ',';
        }
    }
    return $ExpensesChart;
}

function revenueForChart($branch = 'all',$month = null, $year = null)
{
    $RevenueChart = '';
    if (is_array($month)) {
        $month = $month[0];
    }
    $thisMonthDaysCount = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    for ($i=1; $i <= $thisMonthDaysCount; $i++) {
        $day = $year.'-'.$month.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
        if ($branch == 'all') {
            $dayRevenue = App\Models\Revenues::whereNotIn('Type',['transfeerFromAnother'])->where('Date',$day)->sum('amount');
        } else {
            $dayRevenue = App\Models\Revenues::whereNotIn('Type',['transfeerFromAnother'])->where('branch_id',$branch)->where('Date',$day)->sum('amount');
        }
        $RevenueChart .= $dayRevenue;
        if ($i<$thisMonthDaysCount) {
            $RevenueChart .= ',';
        }
    }
    return $RevenueChart;
}
function expensesTotals($branch = 'all',$month = null, $year = null)
{
    $totalManagmentExpenses = App\Models\Expenses::whereNotIn('Type',['withdrawal','transfeerToAnother'])
                                            ->whereIn('month',$month)
                                            ->where('year',$year);
    $totalSalariesExpenses = App\Models\SalaryRequest::whereIn('month',$month)
                                                ->where('year',$year);
    $totalWithdrawalExpenses = App\Models\Expenses::where('Type','withdrawal')
                                            ->whereIn('month',$month)
                                            ->where('year',$year);

    $yearManagmentExpenses = App\Models\Expenses::whereNotIn('Type',['withdrawal','transfeerToAnother'])
                                            ->where('year',$year);
    $yearSalariesExpenses = App\Models\SalaryRequest::where('year',$year);
    $yearWithdrawalExpenses = App\Models\Expenses::where('Type','withdrawal')
                                            ->where('year',$year);

    if ($branch != 'all') {
        $totalManagmentExpenses = $totalManagmentExpenses->where('branch_id',$branch);
        $totalSalariesExpenses = $totalSalariesExpenses->where('branch_id',$branch);
        $totalWithdrawalExpenses = $totalWithdrawalExpenses->where('branch_id',$branch);

        $yearManagmentExpenses = $yearManagmentExpenses->where('branch_id',$branch);
        $yearSalariesExpenses = $yearSalariesExpenses->where('branch_id',$branch);
        $yearWithdrawalExpenses = $yearWithdrawalExpenses->where('branch_id',$branch);
    }

    $totalManagmentExpenses = $totalManagmentExpenses->sum('Expense');
    $totalSalariesExpenses = $totalSalariesExpenses->sum('DeliveredSalary');
    $totalWithdrawalExpenses = $totalWithdrawalExpenses->sum('Expense');

    $yearManagmentExpenses = $yearManagmentExpenses->sum('Expense');
    $yearSalariesExpenses = $yearSalariesExpenses->sum('DeliveredSalary');
    $yearWithdrawalExpenses = $yearWithdrawalExpenses->sum('Expense');

    return [
        'management' => $totalManagmentExpenses,
        'salaries' => $totalSalariesExpenses,
        'withdrawal' => $totalWithdrawalExpenses,
        'total' => $totalManagmentExpenses + $totalSalariesExpenses + $totalWithdrawalExpenses,
        'yearTotal' => $yearManagmentExpenses + $yearSalariesExpenses + $yearWithdrawalExpenses
    ];
}
function revenuesTotals($branch = 'all',$month = 'all', $year = 'all')
{
    $month_revenues = App\Models\Revenues::whereNotIn('Type',['transfeerFromAnother','deposits'])
                                            ->whereIn('month',$month)
                                            ->where('year',$year);
    $totalDeposits = App\Models\Revenues::where('Type','deposits')
                                            // ->where('month',$month)
                                            ->where('year',$year);

    $yearRevenues = App\Models\Revenues::whereNotIn('Type',['transfeerFromAnother','deposits'])->where('year',$year);
    $yearDeposits = App\Models\Revenues::where('Type','deposits')->where('year',$year);

    if ($branch != 'all') {
        $month_revenues = $month_revenues->where('branch_id',$branch);
        $totalDeposits = $totalDeposits->where('branch_id',$branch);

        $yearRevenues = $yearRevenues->where('branch_id',$branch);
        $yearDeposits = $yearDeposits->where('branch_id',$branch);
    }

    $month_revenues = $month_revenues->sum('amount');
    $totalDeposits = $totalDeposits->sum('amount');

    $yearRevenues = $yearRevenues->sum('amount');
    $yearDeposits = $yearDeposits->sum('amount');

    return [
        'month_revenues' => $month_revenues,
        'deposits' => $totalDeposits,
        'total' => $yearRevenues + $totalDeposits,
        'year_revenues' => $yearRevenues
    ];
}
function teamFollowupsStats($leader,$month = null, $year = null)
{
    $thisMonth = date('m');
    $thisYear = date('Y');
    if ($month != null) {
        $thisMonth = $month;
    }
    if ($year != null) {
        $thisYear = $year;
    }
    $teamMembers[] = $leader;
    $myTeam = App\Models\User::where('status','Active')->where('leader',$leader)->get();
    foreach ($myTeam as $myTeamKey => $myTeamV) {
        $teamMembers[] = $myTeamV['id'];
    }
    $followUps = App\Models\ClientFollowUps::where('status','Done')
                                ->where('month',$month)
                                ->where('year',$year)
                                ->whereIn('UID',$teamMembers)->get();
    $list = [
        'Mail' => $followUps->where('contactingType','Mail')->count(),
        'Call' => $followUps->where('contactingType','Call')->count(),
        'InVisit' => $followUps->where('contactingType','InVisit')->count(),
        'OutVisit' => $followUps->where('contactingType','OutVisit')->count(),
        'UnitVisit' => $followUps->where('contactingType','UnitVisit')->count()
    ];

    return $list;
}
function teamMonthFollowupsStats($leader,$month = null, $year = null)
{
    $numbers = [
        'Mail' => '',
        'Call' => '',
        'InVisit' => '',
        'OutVisit' => '',
        'UnitVisit' => ''
    ];
    $thisMonthDaysCount = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    $teamMembers[] = $leader;
    $myTeam = App\Models\User::where('status','Active')->where('leader',$leader)->get();
    foreach ($myTeam as $myTeamKey => $myTeamV) {
        $teamMembers[] = $myTeamV['id'];
    }
    for ($i=1; $i <= $thisMonthDaysCount; $i++) {
        $day = $year.'-'.$month.'-'.$i;
        $followUps = App\Models\ClientFollowUps::where('status','Done')
                                    ->where('contactingDateTime',$day)
                                    ->where('year',$year)
                                    ->whereIn('UID',$teamMembers)->get();
        $emails = $followUps->where('contactingType','Mail')->count();
        $numbers['Mail'] .= $emails;
        if ($i<$thisMonthDaysCount) {
            $numbers['Mail'] .= ',';
        }

        $Calls = $followUps->where('contactingType','Call')->count();
        $numbers['Call'] .= $Calls;
        if ($i<$thisMonthDaysCount) {
            $numbers['Call'] .= ',';
        }

        $InVisits = $followUps->where('contactingType','InVisit')->count();
        $numbers['InVisit'] .= $InVisits;
        if ($i<$thisMonthDaysCount) {
            $numbers['InVisit'] .= ',';
        }

        $OutVisits = $followUps->where('contactingType','OutVisit')->count();
        $numbers['OutVisit'] .= $OutVisits;
        if ($i<$thisMonthDaysCount) {
            $numbers['OutVisit'] .= ',';
        }

        $UnitVisits = $followUps->where('contactingType','UnitVisit')->count();
        $numbers['UnitVisit'] .= $UnitVisits;
        if ($i<$thisMonthDaysCount) {
            $numbers['UnitVisit'] .= ',';
        }
    }
    return $numbers;
}
function branchFollowupsStats($branch,$month = null, $year = null)
{
    $thisMonth = date('m');
    $thisYear = date('Y');
    if ($month != null) {
        $thisMonth = $month;
    }
    if ($year != null) {
        $thisYear = $year;
    }
    if ($branch == 'all') {
        $followUps = App\Models\ClientFollowUps::where('status','Done')
                                    ->where('month',$month)
                                    ->where('year',$year)->get();
    } else {
        $branchMembers[] = $branch;
        $mybranch = App\Models\User::where('status','Active')->where('branch_id',$branch)->get();
        foreach ($mybranch as $mybranchKey => $mybranchV) {
            $branchMembers[] = $mybranchV['id'];
        }
        $followUps = App\Models\ClientFollowUps::where('status','Done')
                                    ->where('month',$month)
                                    ->where('year',$year)
                                    ->whereIn('UID',$branchMembers)->get();
    }

    $list = [
        'Mail' => $followUps->where('contactingType','Mail')->count(),
        'Call' => $followUps->where('contactingType','Call')->count(),
        'InVisit' => $followUps->where('contactingType','InVisit')->count(),
        'OutVisit' => $followUps->where('contactingType','OutVisit')->count(),
        'UnitVisit' => $followUps->where('contactingType','UnitVisit')->count()
    ];

    return $list;
}
function branchMonthFollowupsStats($branch,$month = null, $year = null)
{
    $numbers = [
        'Mail' => '',
        'Call' => '',
        'InVisit' => '',
        'OutVisit' => '',
        'UnitVisit' => ''
    ];
    $thisMonthDaysCount = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    if ($branch == 'all') {
        $mybranch = App\Models\User::where('status','Active')->get();
        foreach ($mybranch as $mybranchKey => $mybranchV) {
            $branchMembers[] = $mybranchV['id'];
        }
    }else {
        $branchMembers[] = $branch;
        $mybranch = App\Models\User::where('status','Active')->where('branch_id',$branch)->get();
        foreach ($mybranch as $mybranchKey => $mybranchV) {
            $branchMembers[] = $mybranchV['id'];
        }
    }
    for ($i=1; $i <= $thisMonthDaysCount; $i++) {
        $day = $year.'-'.$month.'-'.$i;
        $followUps = App\Models\ClientFollowUps::where('status','Done')
                                    ->where('contactingDateTime',$day)
                                    ->where('year',$year)
                                    ->whereIn('UID',$branchMembers)->get();
        $emails = $followUps->where('contactingType','Mail')->count();
        $numbers['Mail'] .= $emails;
        if ($i<$thisMonthDaysCount) {
            $numbers['Mail'] .= ',';
        }

        $Calls = $followUps->where('contactingType','Call')->count();
        $numbers['Call'] .= $Calls;
        if ($i<$thisMonthDaysCount) {
            $numbers['Call'] .= ',';
        }

        $InVisits = $followUps->where('contactingType','InVisit')->count();
        $numbers['InVisit'] .= $InVisits;
        if ($i<$thisMonthDaysCount) {
            $numbers['InVisit'] .= ',';
        }

        $OutVisits = $followUps->where('contactingType','OutVisit')->count();
        $numbers['OutVisit'] .= $OutVisits;
        if ($i<$thisMonthDaysCount) {
            $numbers['OutVisit'] .= ',';
        }

        $UnitVisits = $followUps->where('contactingType','UnitVisit')->count();
        $numbers['UnitVisit'] .= $UnitVisits;
        if ($i<$thisMonthDaysCount) {
            $numbers['UnitVisit'] .= ',';
        }
    }
    return $numbers;
}

function homeStates()
{
    return [
        'todayClients' => App\Models\User::whereDate('created_at', Carbon::today())->count(),
        'monthClients' => App\Models\User::whereMonth('created_at', Carbon::now()->month)->count(),
        'monthDisqualifiedClients' => App\Models\User::where('status','disqualified')->whereMonth('created_at', Carbon::now()->month)->count(),
        'monthLostClients' => App\Models\User::where('status','lost')->whereMonth('created_at', Carbon::now()->month)->count(),
        'monthCurrentClients' => App\Models\User::where('status','current')->whereMonth('created_at', Carbon::now()->month)->count(),
    ];
}

function clientsPageStats($month, $year, $employee = 'all', $source = 'all', $service = 'all')
{
    $sourceClients = App\Models\Clients::where('status','!=','current');
    if ($month != 'all') {
        $sourceClients = $sourceClients->whereMonth('updated_at',$month);
    }
    if ($year != 'all') {
        $sourceClients = $sourceClients->whereYear('updated_at',$year);
    }
    $sourceClients = $sourceClients->get();

    if ($employee != 'all') {
        $sourceClients = $sourceClients->where('UID',$employee);
    }
    if ($source != 'all') {
        $sourceClients = $sourceClients->where('referral',$source);
    }
    $list = [
        'open' => $sourceClients->where('status','open')->count(),
        'opportunity' => $sourceClients->where('status','opportunity')->count(),
        'preparingProposal' => $sourceClients->where('status','preparingProposal')->count(),
        'proposal' => $sourceClients->where('status','proposal')->count(),
        'lost' => $sourceClients->where('status','lost')->count(),
        'delayed' => $sourceClients->where('status','delayed')->count()
    ];
    return $list;
}

function cotractsPageStats($month, $year, $agent = 'all', $client = 'all')
{
    $contracts = App\Models\ClientContracts::where('status','!=','cancel');
    if ($month != 'all') {
        $contracts = $contracts->where('month',$month);
    }
    if ($year != 'all') {
        $contracts = $contracts->where('year',$year);
    }
    if (isset($_GET['paymentStatus'])) {
        if ($_GET['paymentStatus'] == 'noPayment') {
            $contracts = $contracts->doesntHave('payments');
        }
        if ($_GET['paymentStatus'] == 'partialPayment') {
            $contracts = $contracts->whereColumn('paid','<', 'Total');
        }
        if ($_GET['paymentStatus'] == 'donePayment') {
            $contracts = $contracts->whereColumn('paid','=', 'Total');
        }
    }
    $contracts = $contracts->get();

    if ($agent != 'all') {
        $contracts = $contracts->where('AgentID',$agent);
    }
    if ($client != 'all') {
        $contracts = $contracts->where('ClientID',$client);
    }
    $list = [];
    $list['total'] = $contracts->count();
    $ids = $contracts->pluck('id')->toArray();
    $payments = App\Models\Revenues::whereIn('contract_id',$ids)->sum('amount');
    $list['payments'] = [
        'total' => number_format($contracts->sum('Total')),
        'paid' => number_format($payments),
        'rest' => number_format($contracts->sum('Total') - $payments)
    ];
    foreach (contractStatusList('ar') as $key => $value) {
        $list[$key] = $contracts->where('Status',$key)->count();
    }
    return $list;
}
