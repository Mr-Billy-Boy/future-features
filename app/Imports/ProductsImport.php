<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;

use Maatwebsite\Excel\Concerns\ToModel;

use Illuminate\Validation\Rule;

class ProductsImport implements 
    ToModel, 
    WithHeadingRow, 
    WithUpserts, 
    // WithChunkReading, 
    WithValidation,
    SkipsOnFailure,
    WithBatchInserts
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return mixed
    */
    public function model(array $row)
    {
        Product::create([
            'name'          => $row['product_name'] ?? $row['name'] ?? null,
            'description'   => $row['product_description'],
            'price'         => $row['product_price'],
            'status'        => $row['product_status'],
        ]);
}

    public function rules(): array
    {
        return [
            'product_status'    => Rule::in(['Published', 'Processing']),
            'product_price'     => [
                'required',
                'integer',
            ]
        ];
    }

    public function customValidationMessages()
    {
        return [
            'product_status.in' => 'Please provide the correct product status',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $this->failures = $failures;
    }
    
    public function failures()
    {
        return $this->failures;
    }

    /*
    * if a user already exists with the same email, the row will be updated instead.
    */
    public function uniqueBy()
    {
        return 'testtest';
    }

    /*
    * Importing a large file can have a huge impact on the memory usage
    * This will read the spreadsheet in chunks and keep the memory usage under control.
    */
    public function chunkSize(): int
    {
        return 100;
    }
    
    public function batchSize(): int
    {
        return 100;
    }
}
