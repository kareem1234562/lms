<?php

if (!function_exists('endsWithAllowedExtensions')) {
    function endsWithAllowedExtensions($filename)
    {
        // Define the allowed extensions
        $allowedExtensions = ['.mb4', '.png', '.mb3'];

        // Check if the filename ends with any of the allowed extensions
        foreach ($allowedExtensions as $extension) {
            if (Str::endsWith($filename, $extension)) {
                return true;
            }
        }

        return false;
    }
}
function getFileType($fileName) {
    // Get the file extension
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Define arrays for supported image, video, and audio extensions
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $videoExtensions = ['mp4', 'webm', 'ogg'];
    $audioExtensions = ['mp3', 'wav', 'ogg'];

    // Check the type of file based on its extension
    if (in_array($fileExtension, $imageExtensions)) {
        return 'image';
    } elseif (in_array($fileExtension, $videoExtensions)) {
        return 'video';
    } elseif (in_array($fileExtension, $audioExtensions)) {
        return 'audio';
    } else {
        return 'unknown'; // For unsupported or unknown file types
    }
}

if (!function_exists('is_text')) {
    function is_text($value) {
        // Check if the value is not a file extension and is a string
        return !is_file($value) && is_string($value);
    }
}

if (!function_exists('is_file')) {
    function is_file($value) {
        // Check if the value represents a file path
        return $value && file_exists(public_path('uploads/OptionsCourse/' . $value));
    }
}
function DayMonthOnly($your_date)
{
    $months = array("Jan" => "يناير",
                     "Feb" => "فبراير",
                     "Mar" => "مارس",
                     "Apr" => "أبريل",
                     "May" => "مايو",
                     "Jun" => "يونيو",
                     "Jul" => "يوليو",
                     "Aug" => "أغسطس",
                     "Sep" => "سبتمبر",
                     "Oct" => "أكتوبر",
                     "Nov" => "نوفمبر",
                     "Dec" => "ديسمبر");
    //$your_date = date('y-m-d'); // The Current Date
    $en_month = date("M", strtotime($your_date));
    foreach ($months as $en => $ar) {
        if ($en == $en_month) { $ar_month = $ar; }
    }

    $find = array ("Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri");
    $replace = array ("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
    $ar_day_format = date("D", strtotime($your_date)); // The Current Day
    $ar_day = str_replace($find, $replace, $ar_day_format);

    header('Content-Type: text/html; charset=utf-8');
    $standard = array("0","1","2","3","4","5","6","7","8","9");
    $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
    $current_date = $ar_day.' '.date('d', strtotime($your_date)).' '.$ar_month.' '.date('Y', strtotime($your_date));
    $arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

    return $arabic_date;
}
function arabicMonth($your_date)
{
    $months = array("Jan" => "يناير",
                     "Feb" => "فبراير",
                     "Mar" => "مارس",
                     "Apr" => "أبريل",
                     "May" => "مايو",
                     "Jun" => "يونيو",
                     "Jul" => "يوليو",
                     "Aug" => "أغسطس",
                     "Sep" => "سبتمبر",
                     "Oct" => "أكتوبر",
                     "Nov" => "نوفمبر",
                     "Dec" => "ديسمبر");
    //$your_date = date('y-m-d'); // The Current Date
    $en_month = date("M", strtotime($your_date));
    foreach ($months as $en => $ar) {
        if ($en == $en_month) { $ar_month = $ar; }
    }
    return $ar_month;
}
function getTime($time)
{
    $time = '';
    $time .= date('H:m',strtotime($time));
    $time .= date('a',strtotime($time)) == 'am' ? ' ص ' : 'م';
    return $time;
}

function panelLangMenu()
{
    $list = [];
    $locales = Config::get('app.locales');

    $selected = null;

    if (Session::get('Lang') != 'ar') {
        $list[] = [
            'flag' => 'sa',
            'text' => trans('common.lang1Name'),
            'lang' => 'ar'
        ];
    } else {
        $selected = [
            'flag' => 'sa',
            'text' => trans('common.lang1Name'),
            'lang' => 'ar'
        ];
    }
    if (Session::get('Lang') != 'en') {
        $list[] = [
            'flag' => 'us',
            'text' => trans('common.lang2Name'),
            'lang' => 'en'
        ];
    } else {
        $selected = [
            'flag' => 'us',
            'text' => trans('common.lang2Name'),
            'lang' => 'en'
        ];
    }

    return [
        'selected' => $selected,
        'list' => $list
    ];
}

function getCssFolder()
{
    return trans('common.cssFile');
}

function contractsList()
{
    return App\Models\ClientContracts::orderBy('id','desc')->pluck('name','id')->all();
}
function instructorsList()
{
    return App\Models\NewInstructors::orderBy('id','desc')->pluck('name','id')->all();
}
function chapters($id)
{
    return App\Models\Chapters::where('id',$id)->orderBy('id','desc')->pluck('number','id')->all();
}
function sectionsList()
{
    return App\Models\CoursesSections::orderBy('id','desc')->pluck('name_ar','id')->all();
}
function getRolesList($lang,$value,$guard = null)
{
    $list = [];
    if ($guard == null) {
        $roles = App\Models\roles::orderBy('name_'.$lang,'asc')->get();
    } else {
        $roles = App\Models\roles::where('guard',$guard)->orderBy('name_'.$lang,'asc')->get();
    }
    foreach ($roles as $role) {
        $list[$role[$value]] = $role['name_'.$lang] != '' ? $role['name_'.$lang] : $role['name_ar'];
    }
    return $list;
}

function getSectionsList($lang)
{
    $list = [];
    $sections = App\Sections::where('main_section','0')->orderBy('name_'.$lang,'asc')->get();
    foreach ($sections as $section) {
        $list[$section['id']] = $section['name_'.$lang];
        if ($section->subSections != '') {
            foreach ($section->subSections as $key => $value) {
                $list[$value['id']] = ' - '.$value['name_'.$lang];
            }
        }
    }
    return $list;
}

function getSettingValue($key)
{
    $value = '';
    $setting = App\Models\Settings::where('key',$key)->first();
    if ($setting != '') {
        $value = $setting['value'];
    }
    return $value;
}

function getSettingImageLink($key)
{
    $link = '';
    $setting = App\Models\Settings::where('key',$key)->first();
    if ($setting != '') {
        if ($setting['value'] != '') {
            $link = asset('uploads/settings/'.$setting['value']);
        }
    }
    return $link;
}

function getSettingImageValue($key)
{
    $value = '';
    if (getSettingImageLink($key) != '') {
        $value .= '<div class="row"><div class="col-12">';
        $value .= '<span class="avatar mb-2">';
        $value .= '<img class="round" src="'.getSettingImageLink($key).'" alt="avatar" height="90" width="90">';
        $value .= '</span>';
        $value .= '</div>';
        $value .= '<div class="col-12">';
        $value .= '<a href="'.route('admin.settings.deletePhoto',['key'=>$key]).'"';
        $value .= ' class="btn btn-danger btn-sm">'.trans("common.delete").'</a>';
        $value .= '</div></div>';
    }
    return $value;
}

function checkUserForApi($lang, $user_id)
{
    if ($lang == '') {
        $resArr = [
            'status' => 'faild',
            'message' => trans('api.pleaseSendLangCode'),
            'data' => []
        ];
        return response()->json($resArr);
    }
    $user = App\Models\User::find($user_id);
    if ($user == '') {
        return response()->json([
            'status' => 'faild',
            'message' => trans('api.thisUserDoesNotExist'),
            'data' => []
        ]);
    }

    return true;
}

function salesStatistics7Days()
{
    $date = \Carbon\Carbon::today()->subDays(7);
    $date7before = new \Carbon\Carbon($date);
    $date7before = $date7before->subDays(7);
    $ClientsCount = App\Models\User::where('role', '3')->where('created_at', '>=', $date)->count();

    return [
        'ClientsCount' => number_format($ClientsCount),
    ];
}

function branchesList()
{
    $branches = App\Models\Branches::orderBy('name','asc')->pluck('name','id')->all();
    return $branches;
}
function managementsList()
{
    $managements = App\Models\Managements::orderBy('name','asc')->pluck('name','id')->all();
    return $managements;
}
function jobsList()
{
    $jobs = App\Models\Jobs::orderBy('name','asc')->pluck('name','id')->all();
    return $jobs;
}

function safesList()
{
    $safes = [];
    if (userCan('expenses_view') || userCan('employees_account_pay_salary')) {
        $safes = App\Models\SafesBanks::orderBy('Title','asc')->pluck('Title','id')->all();
    } elseif (userCan('expenses_view_branch')) {
        $safes = App\Models\SafesBanks::where('branch_id',auth()->user()->branch_id)->orderBy('Title','asc')->pluck('Title','id')->all();
    }
    return $safes;
}
function agentsList()
{
    $agents = App\Models\User::where('status','Active')->orderBy('name','asc')->pluck('name','id')->all();
    return $agents;
}
function clientSourceList()
{
    $sources = App\Models\Clientsources::orderBy('name','asc')->pluck('name','id')->all();
    return $sources;
}
function unsignedClientsForGroups($course_id = null)
{
    $clients = App\Models\CourseGroupClients::where('group_id','0');
    if ($course_id != null) {
        $clients = $clients->where('course_id',$course_id);
    }
    $clients = $clients->get();

    $list = [];
    foreach ($clients as $key => $value) {
        if ($value->client != '') {
            $list[$value['id']] = $value->client->Name;
        }
    }
    return $list;
}
function groupClientsList($course_id)
{
    $groups = App\Models\CourseGroups::where('course_id',$course_id)->get();

    $list = [];
    foreach ($groups as $key => $value) {
        $list[$value['id']] = 'مجموعة رقم: #'.$value['id'];
    }
    return $list;
}
function servicesList()
{
    $services = App\Models\Services::orderBy('name','asc')->pluck('name','id')->all();
    return $services;
}
function coursesList()
{
    $courses = App\Models\Courses::orderBy('name','asc')->pluck('name','id')->all();
    return $courses;
}
function eventsList()
{
    $events = App\Models\Events::orderBy('title','asc')->pluck('title','id')->all();
    return $events;
}
function coursesGet()
{
    $courses = App\Models\Courses::orderBy('name','asc')->get();
    return $courses;
}

function availableGroupsList($course_id)
{
    $groups = App\Models\CourseGroups::where('course_id',$course_id)->get();

    $list = [];
    foreach ($groups as $key => $value) {
        $list[$value['id']] = 'مجموعة رقم: #'.$value['id'];
    }
    return $list;
}
function workingDaysList()
{
    $list = [
        'Saturday' => 'السبت',
        'Sunday' => 'الأحد',
        'Monday' => 'الإثنين',
        'Tuesday' => 'الثلاثاء',
        'Wednesday' => 'الأربعاء',
        'Thursday' => 'الخميس'
    ];
    return $list;
}
function workingDaysListForTeacher()
{

    $list = [
        'Saturday' => 'السبت',
        'Sunday' => 'الأحد',
        'Monday' => 'الإثنين',
        'Tuesday' => 'الثلاثاء',
        'Wednesday' => 'الأربعاء',
        'Thursday' => 'الخميس'
    ];
    return $list;
}
function dayTimes()
{
    $list = [];
    for ($i=10; $i < 22; $i++) {
        $list[] = $i.':00';
    }
    return $list;
}
function getThisTimeCourse($day, $time) {
    $data = '';
    $this_time_course = App\Models\CourseGroupTimes::where('time_from',$time)->where('day',$day)->first();
    if ($this_time_course != '') {
        if ($this_time_course->group != '') {
            if ($this_time_course->group->status != '2') {
                $index_from = array_search($time, dayTimes());
                $index_to = array_search($this_time_course->time_to, dayTimes());
                $data = [
                    'colspan' => ($index_to - $index_from),
                    'class' => 'btn btn-sm btn-success',
                    'course_name' => $this_time_course->course->name. '<br> مجموعة: #'.$this_time_course->group_id
                ];
                return $data;
            }
        }
    } else {
        // $this_time_course = App\Models\CourseGroupTimes::where('time_to',$time)->where('day',$day)->first();
        // if ($this_time_course != '') {
        //     $data = [
        //         'colspan' => '0',
        //         'class' => 'bg-success',
        //         'course_name' => $this_time_course->course->name. '<br> مجموعة: #'.$this_time_course->group_id
        //     ];
        //     return $data;
        // } else {
            $index = array_search($time, dayTimes());
            $index_before = $index-1;
            if (isset(dayTimes()[$index-1])) {
                $before_time_course = App\Models\CourseGroupTimes::where('time_to',dayTimes()[$index-1])->where('day',$day)->first();
                if ($before_time_course != '') {
                    if ($before_time_course->group != '') {
                        if ($before_time_course->group->status != '2') {
                            $data = [
                                'colspan' => '0',
                                'class' => 'btn btn-sm btn-success',
                                'course_name' => $before_time_course->course->name. '<br> مجموعة: #'.$before_time_course->group_id
                            ];
                            return $data;
                        }
                    }
                }
            }
        // }
    }
    return $data;
}
function todayGroups()
{
    $list = [];
    $courses = App\Models\CourseGroups::where('status',1)->whereHas('times', function($query) {
                            $query->where('day', '=', date('l'));
                        })->get();

    return $courses;
}
function serviceRenewalsList()
{
    $list = [
        '0' => 'تدفع مرة واحده',
        '1' => 'تجديد شهرياً',
        '3' => 'تجديد كل ثلاث أشهر',
        '6' => 'تجديد نصف سنوي',
        '12' => 'تجديد سنوي',
        '24' => 'تجديد كل سنتين'
    ];
    return $list;
}
function agentsListForSearch()
{
    $agents = App\Models\User::where('status','Active')->orderBy('name','asc')->pluck('name','id')->all();;
    // if (auth()->user()->role == '1') {
    //     $agents = App\Models\User::where('status','Active')->where('role',$role_id)->orderBy('name','asc')->pluck('name','id')->all();
    // }elseif (userCan('followups_view_branch')) {
    //     $agents = App\Models\User::where('status','Active')->where('role',$role_id)->where('branch_id',auth()->user()->id)
    //                                                 ->orderBy('name','asc')
    //                                                 ->pluck('name','id')
    //                                                 ->all();
    // }elseif (userCan('followups_view_team')) {
    //     $agents = [auth()->user()->id => auth()->user()->name] + App\Models\User::where('status','Active')->where('role',$role_id)
    //                                                                     ->where('leader',auth()->user()->id)
    //                                                                     ->orderBy('name','asc')
    //                                                                     ->pluck('name','id')
    //                                                                     ->all();
    // }
    return $agents;
}
function agentsVisitList()
{
    $agents = App\Models\User::where('status','Active')->orderBy('name','asc')->pluck('name','id')->all();
    if (userCan('clients_view_team')) {
        $agents = [auth()->user()->id => auth()->user()->name] + App\Models\User::where('status','Active')
                                                                        ->where('leader',auth()->user()->id)
                                                                        ->orderBy('name','asc')
                                                                        ->pluck('name','id')
                                                                        ->all();
    }
    if (userCan('clients_view_branch')) {
        $agents = App\Models\User::where('status','Active')->where('branch_id',auth()->user()->id)
                                                    ->orderBy('name','asc')
                                                    ->pluck('name','id')
                                                    ->all();
    }
    return $agents;
}
function clientsList()
{
    if (userCan('clients_view')) {
        $agents = App\Models\Clients::orderBy('Name','asc')->pluck('Name','id')->all();
    } else {
        $agents = App\Models\Clients::where('UID',auth()->user()->id)->orderBy('Name','asc')->pluck('Name','id')->all();
    }
    return $agents;
}
function clientSalesStatusArray($lang)
{
    $list = [
        'ar' => [
            'checkout_followup' => 'متابعه',
            'checkout_reject' => 'رفض',
            'booking_followup' => 'متابعه استكمال الاوراق',
            'booking_contract' => 'Booking/Contract Sign up'
        ],
        'en' => [
            'checkout_followup' => 'Checkout/Followup',
            'checkout_reject' => 'Checkout/Reject',
            'booking_followup' => 'Booking/Contract Followup',
            'booking_contract' => 'Booking/Contract Sign up'
        ]
    ];
    return $list[$lang];
}
function clientStatuslist($lang)
{
    $list = [
        'ar' => [
            'archive' => 'أرشيف',
            'current' => 'عميل حالي'
        ],
        'en' => [
            'archive' => 'archive',
            'current' => 'active'
        ]
    ];
    return $list[$lang];
}
function clientStatusArray($lang)
{
    $list = [
        'ar' => [
            'no_answer' => 'لا يرد',
            'call_back' => 'تواصل مرة أخرى',
            'no_interest' => 'غير مهتم',
            'interested' => 'مهتم',
            'wrong_number' => 'رقم خاطئ / لا تتصل',
            'checkout_followup' => 'متابعه',
            'whatsapp_followup' => 'متابعة رسائل واتس',
            'date_booking' => 'تم حجز موعد',
            'date_done' => 'تم الحضور',
            'booking_done' => 'تم حجز دورة تدريبية',
            'booking_contract' => 'تم التعاقد على دورة تدريبية'
        ],
        'en' => [
            'no_answer' => 'No Answer',
            'call_back' => 'Call Back',
            'no_interest' => 'No Interest',
            'interested' => 'interested',
            'wrong_number' => 'Wrong Number / don\'t call',
            'checkout_followup' => 'Checkout/Followup',
            'booking_followup' => 'Booking/Contract Followup',
            'whatsapp_followup' => 'Whatsapp Followup',
            'date_booking' => 'Date Booking',
            'date_done' => 'Client Came Through',
            'booking_done' => 'Booking Done',
            'booking_contract' => 'Booking/Contract Sign up'
        ]
    ];
    return $list[$lang];
}
function clientPositionsArray($lang,$archive = 'yes')
{
    $list = [
        'ar' => [
            'call_center' => 'Call Center',
            'reception' => 'الاستقبال',
            'sales' => 'عميل حالي',
            'contract' => 'عميل متعاقد',
            'archive' => 'أرشيف'
        ],
        'en' => [
            'call_center' => 'Call Center',
            'reception' => 'Reception',
            'sales' => 'Sales',
            'contract' => 'Contracted',
            'archive' => 'Archive'
        ]
    ];
    if($archive == 'no'){
        unset($list['ar']['contract']);
        unset($list['ar']['archive']);
        unset($list['en']['contract']);
        unset($list['en']['archive']);
    }
    return $list[$lang];
}
function supportHousingList($lang)
{
    $list = [
        'ar' => [
            'worthy' => 'مستحق',
            'not_worthy' => 'غير مستحق'
        ],
        'en' => [
            'worthy' => 'Worthy',
            'not_worthy' => 'Not Worthy'
        ]
    ];
    return $list[$lang];
}
function clientJobsList($lang)
{
    $list = [
        'ar' => [
            'military' => 'عسكري',
            'governmental_civil' => 'حكومي/مدني',
            'private_sector' => 'قطاع خاص',
            'retired' => 'متقاعد',
            'deposits' => 'الامانات',
            'Organizations' => 'الهيئات',
            'health' => 'الصحة',
            'education' => 'التعليم'
        ],
        'en' => [
            'military' => 'Military',
            'governmental_civil' => 'Governmental/Civil',
            'private_sector' => 'Private Sector',
            'retired' => 'Retired',
            'deposits' => 'Deposits',
            'Organizations' => 'Organizations',
            'health' => 'Health',
            'education' => 'Education'
        ]
    ];
    return $list[$lang];
}

function callCenterRejectionCauses($lang)
{
    $list = [
        'ar' => [
            'callCenter_financial_ability' => 'القدرة المالية',
            'callCenter_project_location' => 'موقع المشروع',
            'callCenter_prices' => 'الاسعار',
            'callCenter_design' => 'التصميم',
            'callCenter_not_qualified_for_support' => 'غير مستحق للدعم',
            'callCenter_supported_before' => 'استفاد سابقاً من الدعم',
            'callCenter_want_ready_unit' => 'يريد عقار جاهز'
        ],
        'en' => [
            'callCenter_financial_ability' => 'Financial Ability',
            'callCenter_project_location' => 'Project Location',
            'callCenter_prices' => 'Prices',
            'callCenter_design' => 'Design',
            'callCenter_not_qualified_for_support' => 'Not Qualified For Support',
            'callCenter_supported_before' => 'Supported Before',
            'callCenter_want_ready_unit' => 'Want Ready Unit'
        ]
    ];
    return $list[$lang];
}

function salesRejectionCauses($lang)
{
    $list = [
        'ar' => [
            'sales_financial_ability' => 'القدرة المالية',
            'sales_project_location' => 'موقع المشروع',
            'sales_prices' => 'الاسعار',
            'sales_design' => 'التصميم',
            'sales_bank_profit_margin' => 'هامش ربح البنك',
            'sales_want_ready_unit' => 'يريد عقار جاهز',
            'sales_not_decided' => 'لم يقرر'
        ],
        'en' => [
            'sales_financial_ability' => 'Financial Ability',
            'sales_project_location' => 'Project Location',
            'sales_prices' => 'Prices',
            'sales_design' => 'Design',
            'sales_bank_profit_margin' => 'Bank Profit Margin',
            'sales_want_ready_unit' => 'Want Ready Unit',
            'sales_not_decided' => 'Not Decided'
        ]
    ];
    return $list[$lang];
}

function unitsTypesList($lang)
{
    $list = [
        'ar' => [
            'Land' => 'أرض',
            'Floor' => 'شقة',
            'House' => 'منزل',
            'Villa' => 'فيلا',
            'Shop' => 'محل',
            'Studio' => 'ستديو',
            'Shalie' => 'شاليه'
        ],
        'en' => [
            'Land' => 'أرض',
            'Floor' => 'شقة',
            'House' => 'منزل',
            'Villa' => 'فيلا',
            'Shop' => 'محل',
            'Studio' => 'ستديو',
            'Shalie' => 'شاليه'
        ]
    ];
    return $list[$lang];
}

function systemMainSections()
{
    $systemMainSections = [
        'settings' => 'settings',
        'users' => 'users',
        'roles' => 'roles',
        'clients' => 'clients',
        'courses' => 'courses',
        'homeStats' => 'homeStats',
    ];
    return $systemMainSections;
}


function getPermissions($role = null)
{

    $roleData = '';
    if ($role != null) {
        $roleData = App\Models\roles::find($role);
    }

    $permissionsArr = [];
    foreach (systemMainSections() as $section) {
        $permissionsArr[$section] = [
            'name' => trans('common.'.$section),
            'permissions' => []
        ];
        $settingPermissions = App\Models\permissions::where('group',$section)->get();
        foreach ($settingPermissions as $permission) {
            $hasIt = 0;
            if ($roleData != '') {
                if ($roleData->hasPermission($permission['id']) == 1) {
                    $hasIt = 1;
                }
            }
            $permissionsArr[$section]['permissions'][] = [
                'id' => $permission['id'],
                'can' => $permission['can'],
                'name' => $permission['name_'.session()->get('Lang')],
                'hasIt' => $hasIt
            ];
        }
    }
    return $permissionsArr;
}

function monthArray($lang)
{
    $arr = [
        'ar' => [
            '01' => '01 يناير',
            '02' => '02 فبراير',
            '03' => '03 مارس',
            '04' => '04 أبريل',
            '05' => '05 مايو',
            '06' => '06 يونيو',
            '07' => '07 يوليو',
            '08' => '08 أغسطس',
            '09' => '09 سبتمبر',
            '10' => '10 أكتوبر',
            '11' => '11 نوفمبر',
            '12' => '12 ديسمبر',
        ],
        'en' => [
            '01' => '01 يناير',
            '02' => '02 فبراير',
            '03' => '03 مارس',
            '04' => '04 أبريل',
            '05' => '05 مايو',
            '06' => '06 يونيو',
            '07' => '07 يوليو',
            '08' => '08 أغسطس',
            '09' => '09 سبتمبر',
            '10' => '10 أكتوبر',
            '11' => '11 نوفمبر',
            '12' => '12 ديسمبر',
        ]
    ];
    return $arr[$lang];
}
function yearArray()
{
    $cunrrentYear = date('Y');
    $firstYear = 2020;
    $arr = [];
    for ($i=$cunrrentYear; $i >= $firstYear; $i--) {
        $arr[$i] = $i;
    }
    return $arr;
}
function employeeStatusArray($lang)
{
    $arr = [
        'ar' => [
            'Active' => 'موظف مفعل',
            'Archive' => 'موظف معطل'
        ]
    ];
    return $arr[$lang];
}
function safeTypes($lang)
{
    $list = [
        'ar' => [
            'safe' => 'خزينة نقدية',
            'bank' => 'حساب بنكي',
            'wallet' => 'محفظة إلكترونية'
        ],
        'en' => [
            'safe' => 'Cash Safe',
            'bank' => 'Banck Account',
            'wallet' => 'Electronic Wallet'
        ]
    ];

    return $list[$lang];
}
function expensesTypes($lang)
{
    $list = [
        'ar' => [
            'withdrawal' => 'مسحوبات',
            'transfeerToAnother' => 'نقل إلى خزينة',
            'contract' => 'مصروفات تعاقد'
        ],
        'en' => [
            'withdrawal' => 'Withdrawal',
            'transfeerToAnother' => 'نقل إلى خزينة',
            'contract' => 'مصروفات تعاقد'
        ]
    ];
    $types = App\Models\ExpensesTypes::orderBy('name','asc')->pluck('name','id')->all();
    return $list[$lang]+$types;
}
function revenuesTypes($lang)
{
    $list = [
        'ar' => [
            'course' => 'إيرادات دورات تدريبية',
            'services' => 'إيرادات خدمات',
            'deposits' => 'إيداعات'
        ],
        'en' => [
            'course' => 'إيرادات دورات تدريبية',
            'services' => 'إيرادات خدمات',
            'deposits' => 'إيداعات'
        ]
    ];
    return $list[$lang];
}

function refferalList($lang)
{
    $list = App\Models\Clientsources::orderBy('name','asc')->pluck('name','id')->all();
    return $list;
}

function contactingTypeList($lang)
{
    $list = [
        'ar' => [
            'phone_call' => 'مكالمة هاتفيه',
            'company_visit' => 'زيارة بالشركة',
            'unit_visit' => 'معاينة للوحدة'
        ],
        'en' => [
            'phone_call' => 'Phone Call',
            'company_visit' => 'Company Visit',
            'unit_visit' => 'Unit Visit'
        ]
    ];
    return $list[$lang];
}

function followUpTypeList($lang)
{
    $list = [
        'ar' => [
            'call_center' => 'Call Center',
            'sales_coordenator' => 'متابعة منسق المبيعات'
        ],
        'en' => [
            'call_center' => 'Call Center',
            'sales_coordenator' => 'Sales Co-ordenator'
        ]
    ];
    return $list[$lang];
}
function whoIsContactingList($lang)
{
    $list = [
        'ar' => [
            'Company' => 'الشركة',
            'Client' => 'العميل'
        ],
        'en' => [
            'Company' => 'Company',
            'Client' => 'Client'
        ]
    ];
    return $list[$lang];
}
function contractStatusList($lang = 'ar')
{
    $list = [
        'ar' => [
            'new' => 'جديد',
            'inProgress' => 'جاري العمل',
            'done' => 'تم الإنتهاء والتسليم',
            'cancel' => 'تم الإلغاء',
            'waitingDeliver' => 'فى انتظار التسليم',
            'onHold' => 'موقوف مؤقتاً'
        ],
        'en' => [
            'new' => 'جديد',
            'inProgress' => 'جاري العمل',
            'done' => 'تم الإنتهاء والتسليم',
            'cancel' => 'تم الإلغاء',
            'waitingDeliver' => 'فى انتظار التسليم',
            'onHold' => 'موقوف مؤقتاً'
        ]
    ];
    return $list[$lang];
}
function contractPaymentStatusList($lang)
{
    $list = [
        'ar' => [
            'noPayment' => 'بدون أي مدفوعات',
            'partialPayment' => 'مدفوع جزئياً',
            'donePayment' => 'مدفوع كاملاً'
        ],
        'en' => [
            'noPayment' => 'بدون أي مدفوعات',
            'partialPayment' => 'مدفوع جزئياً',
            'donePayment' => 'مدفوع كاملاً'
        ]
    ];
    return $list[$lang];
}


function themeModeClasses()
{
    if (session()->get('theme_mode') == 'light') {
        $arr = [
            'html' => 'semi-dark-layout',
            'navbar' => 'navbar-light',
            'icon' => 'moon',
            'menu' => 'menu-dark'
        ];
    } else {
        $arr = [
            'html' => 'dark-layout',
            'navbar' => 'navbar-dark',
            'icon' => 'sun',
            'menu' => 'menu-dark'
        ];
    }
    return $arr;
}

function iconsList() {
    return [
        'flaticon-design' => 'flaticon-design',
        'flaticon-studying' => 'flaticon-studying',
        'flaticon-corporate' => 'flaticon-corporate',
        'flaticon-online-course' => 'flaticon-online-course',
        'flaticon-customer-satisfaction' => 'flaticon-customer-satisfaction',
        'flaticon-platform' => 'flaticon-platform',
        'flaticon-list' => 'flaticon-list',
        'flaticon-mail-inbox-app' => 'flaticon-mail-inbox-app',
        'flaticon-effective' => 'flaticon-effective',
        'flaticon-chevron' => 'flaticon-chevron',
        'flaticon-online-course-1' => 'flaticon-online-course-1',
        'flaticon-reading-book' => 'flaticon-reading-book',
        'flaticon-camera' => 'flaticon-camera',
        'flaticon-heart-beat' => 'flaticon-heart-beat',
        'flaticon-left-arrow' => 'flaticon-left-arrow',
        'flaticon-play-button-arrowhead' => 'flaticon-play-button-arrowhead',
        'flaticon-wellness' => 'flaticon-wellness',
        'flaticon-web-development' => 'flaticon-web-development',
        'flaticon-discount' => 'flaticon-discount',
        'flaticon-folder' => 'flaticon-folder',
        'flaticon-quotation' => 'flaticon-quotation',
        'flaticon-check' => 'flaticon-check',
        'flaticon-quote' => 'flaticon-quote',
        'flaticon-student' => 'flaticon-student',
        'flaticon-email' => 'flaticon-email',
        'flaticon-user' => 'flaticon-user',
        'flaticon-checked' => 'flaticon-checked',
        'flaticon-phone-call' => 'flaticon-phone-call'
    ];
}
