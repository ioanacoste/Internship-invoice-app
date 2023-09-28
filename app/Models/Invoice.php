<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
    class Invoice extends Model
{
    protected $table = 'invoices';
    use HasFactory;
    public function clients() {
        return $this->belongsTo(Client::class,'client_id');
    }
    public function products() {
	        return $this->hasMany(Product::class);
	    }
}
