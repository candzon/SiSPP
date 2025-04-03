<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workorder extends Model
{
    //
    protected $fillable = [
        'id',
        'user_id',
        'kelas',
        'jumlah',
        'status',
        'tanggal_pembayaran',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function lastWorkOrder()
    {
        return static::whereDate('created_at', today())->latest()->first();
    }

    public static function getWorkOrders()
    {
        return static::join('users', 'workorders.user_id', '=', 'users.id')
            ->select('workorders.*', 'users.name as siswa_name')
            ->orderBy('workorders.created_at', 'desc')
            ->get();
    }

    public static function getWorkOrderByOperator($id)
    {
        return static::join('users', 'workorders.user_id', '=', 'users.id')
            ->select('workorders.*', 'users.name as siswa_name')
            ->where('workorders.user_id', $id)
            ->orderBy('workorders.created_at', 'desc')
            ->get();
    }

    public static function getWorkOrderByStatus($status, $id)
    {
        return static::join('users', 'workorders.user_id', '=', 'users.id')
            ->select('workorders.*', 'users.name as siswa_name')
            ->where('status', $status)
            ->where('user_id', $id)
            ->orderBy('workorders.created_at', 'desc')
            ->get();
    }

    public static function countWorkOrderByStatus($status)
    {
        return static::where('status', $status)->count();
    }

    public static function countWorkOrderByStatusAssigned($status, $id)
    {
        return static::where('status', $status)
            ->where('user_id', $id)
            ->count();
    }

}
