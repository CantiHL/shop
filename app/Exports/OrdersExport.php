<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Color;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
use Maatwebsite\Excel\Concerns\WithHeadings;

// Trả về một mảng chứa các tiêu đề của các cột trong Excel
class OrdersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithBackgroundColor
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->select('product_id','products.name','products.price', DB::raw('SUM(orders.quantity) as quantity'))
        ->where('orders.status', '=', 'done')
        ->groupBy('product_id', 'products.name', 'products.price')
        ->get();
    }
    public function headings(): array
    {
        return ['Id','Name', 'Price', 'Quantity'];
    }
    public function backgroundColor()
    {
        return new Color(Color::COLOR_BLUE);
    }
}
