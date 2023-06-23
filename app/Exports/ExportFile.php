<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportFile implements FromCollection, WithMapping, WithHeadings, WithColumnWidths
{
    private $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'Tên sản phẩm',
            'Thể loại',
            'Giá gốc',
            'Giá khuyến mãi',
            'Mô tả',
            'Tác giả',
        ];
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->category ? $product->category->name : 'Đang cập nhật',
            $product->origin_price ? number_format($product->origin_price) : '',
            $product->sale_price ? number_format($product->sale_price) : '',
            $product->content ?: '',
            $product->author ? $product->author->name : 'Đang cập nhật',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 25,
            'C' => 15,
            'D' => 15,
            'E' => 20,
            'F' => 15,
        ];
    }
}
