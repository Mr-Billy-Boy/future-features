<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use Illuminate\Http\Request;

use Excel;

class ProductController extends Controller
{
    public function import() 
    {
        $import = new ProductsImport();
        // $import->import('products.csv');
        $import->import('products-1000.csv');
        // $import->import('products-with-error.csv');
        $failures = $import->failures();

        dd($failures);

        return 'Successfully created.';
    }
}
