<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminLog;

class AdminController extends Controller
{
    public function dashboard()
    {
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

        $logs = AdminLog::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage);
    	return view('admin.dashboard.index', compact('logs', 'filterUser', 'filterTable', 'filterType', 'order', 'pagination'));
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
