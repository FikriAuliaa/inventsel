<?php

namespace App\Exports;

use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BorrowingExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Borrowing::with(['user', 'borrowingDetails.productInstance.product'])->get();
    }

    public function headings(): array
    {
        return [
            'ID Peminjaman',
            'Nama Peminjam',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Daftar Barang (Kode Unik)'
        ];
    }

    public function map($borrowing): array
    {
        $items = [];
        foreach ($borrowing->borrowingDetails as $detail) {
            $items[] = $detail->productInstance->product->nama_barang . ' (' . $detail->productInstance->kode_unik . ')';
        }

        return [
            $borrowing->id,
            $borrowing->user->name,
            $borrowing->tanggal_pinjam,
            $borrowing->tanggal_kembali ?? '-',
            $borrowing->status,
            implode(', ', $items)
        ];
    }
}