<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Controllers\InvoicesListController;

class InvoiceList extends Model
{
    protected $table = ['invoices','clients'];
    public function products()
{
    return $this->hasMany(Product::class, 'invoice_id');
}
    
}
