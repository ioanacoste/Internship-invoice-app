 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('invoice_id');
        $table->string('ProductService');
        $table->string('Unit');
        $table->integer('Quantity');
        $table->float('VATrate');
        $table->float('UnitPrice');
        $table->float('PriceWithoutVAT');
        $table->float('PriceWithVAT');
        $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
}

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
