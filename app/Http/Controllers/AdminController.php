<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminLog;
use App\User;
use App\Role;

class AdminController extends Controller
{
    public function dashboard()
    {
    	$filterDescription = request()->filterDescription;
    	$filterUser = request()->filterUser;
        $filterTable = request()->filterTable;
        $filterType = request()->filterType;
        $order = request()->order;
        $pagination = request()->pagination;

        if (!$pagination == null) {
            $perPage = $pagination;
        } else {
            $perPage = 12;
        }

        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        $logs = AdminLog::description($filterDescription)
        	->userId($filterUser)
        	->table($filterTable)
        	->type($filterType)
        	->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
        	->paginate($perPage);

        $adminUsers = Role::where('name', 'admin')->first()->users()->get();

    	return view('admin.dashboard.index', compact('logs', 'adminUsers', 'filterDescription', 'filterUser', 'filterTable', 'filterType', 'order', 'pagination'));
    }

    public function exportFile($filename, $type, $filterDescription, $filterUser, $filterTable, $filterType, $order, $ids = null)
    {
        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        if ($filterDescription == "null") { $filterDescription =""; }
        if ($filterUser == "null") { $filterUser =""; }
        if ($filterTable == "null") { $filterTable =""; }
        if ($filterType == "null") { $filterType =""; }

        if ($ids) {
            $ids = explode(",",$ids);
            $logs = AdminLog::whereIn('id', $ids)
            	->description($filterDescription)
	        	->userId($filterUser)
	        	->table($filterTable)
	        	->type($filterType)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $logs = AdminLog::description($filterDescription)
	        	->userId($filterUser)
	        	->table($filterTable)
	        	->type($filterType)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if ($filename == null) {
            $filename = 'logs_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($logs) {
            $excel->sheet('logs', function($sheet) use ($logs)
            {
                $sheet->fromArray($logs);
            });
        })->download($type);
    }

     /*
     * HELPERS FUNCTIONS
     *
     */
    protected function getOrder($order) {
        $order_ext = [
            'default' => [
                'sortField'     => 'created_at',
                'sortDirection' => 'desc'
            ],
            'date' => [
                'sortField'     => 'created_at',
                'sortDirection' => 'asc'
            ],
            'date_desc' => [
                'sortField'     => 'created_at',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }

    public function generalSettings()
    {
    	return view('admin.general_settings');
    }
}
