<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\Revenues;
use App\Models\User;

class ReportsController extends Controller
{
    //
    public function rejectionCauses()
    {
        //check if authenticated
        if (!userCan('reports_rejectionCauses')) {
            return redirect()->route('admin.index')
                                ->with('faild',trans('common.youAreNotAuthorized'));
        }
        return view('AdminPanel.reports.rejectionCauses',[
            'active' => 'rejectionCauses',
            'title' => trans('common.rejectionCauses'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.rejectionCauses')
                ]
            ]
        ]);
    }
    public function teamPerformance()
    {
        //check if authenticated
        if (!userCan('reports_teamPerformance')) {
            return redirect()->route('admin.index')
                                ->with('faild',trans('common.youAreNotAuthorized'));
        }
        return view('AdminPanel.reports.teamPerformance',[
            'active' => 'teamPerformance',
            'title' => trans('common.teamPerformance'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.reports')
                ],
                [
                    'url' => '',
                    'text' => trans('common.teamPerformance')
                ]
            ]
        ]);
    }
    public function clients()
    {
        //check if authenticated
        if (!userCan('reports_clients')) {
            return redirect()->route('admin.index')
                                ->with('faild',trans('common.youAreNotAuthorized'));
        }
        return view('AdminPanel.reports.clients',[
            'active' => 'reports_clients',
            'title' => trans('common.clients'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.reports')
                ],
                [
                    'url' => '',
                    'text' => trans('common.clients')
                ]
            ]
        ]);
    }
    public function units()
    {
        //check if authenticated
        if (!userCan('reports_units')) {
            return redirect()->route('admin.index')
                                ->with('faild',trans('common.youAreNotAuthorized'));
        }
        return view('AdminPanel.reports.units',[
            'active' => 'reports_units',
            'title' => trans('common.units'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.reports')
                ],
                [
                    'url' => '',
                    'text' => trans('common.units')
                ]
            ]
        ]);
    }
    public function accountsReport()
    {
        //check if authenticated
        if (!userCan('reports_accounts_view') && !userCan('reports_accounts_view_branch')) {
            return redirect()->route('admin.index')
                                ->with('faild',trans('common.youAreNotAuthorized'));
        }
        return view('AdminPanel.reports.accounts',[
            'active' => 'accountsReport',
            'title' => trans('common.accountsReport'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.accountsReport')
                ]
            ]
        ]);
    }

}
