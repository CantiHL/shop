<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

// Trả về một mảng chứa các tiêu đề của các cột trong Excel
class OrdersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->select('product_id','products.name','products.price', DB::raw('COUNT(quantity) as quantity'))
        ->where('orders.status', '=', 'done')
        ->groupBy('product_id', 'products.name', 'products.price')
        ->get();;
    }
    public function headings(): array
    {
        return ['Id','Name', 'Price', 'Quantity'];
    }
}
