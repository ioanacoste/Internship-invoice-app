 <?php
	use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration
	{
	    
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
	            $table->id();
				$table->unsignedBigInteger('client_id');
            	$table->date('DateOfIssue');
	            $table->date('Term');
	            $table->string('SeriesNumber')->unique();
	            $table->string('lang');
	            $table->string('currency1');
            	$table->string('Made');
            	$table->string('ID_made');
            	$table->string('email_made');
				$table->string('phone');
            	$table->string('Delegate');
	            $table->string('ID_delegate');
            	$table->string('email_delegate');
				$table->string('phone_delegate');
            	$table->string('NoNotice')->unique();
	            $table->string('Mentions');
	            $table->date('DeliveryDate')->format('d-m-Y');
	            $table->date('DateofCollection')->format('d-m-Y');
	            $table->string('method');
                $table->string('status')->default('draft')->nullable();
	          $table->timestamps();
			  $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
	        });
	    }
	
	    /**
	     * Reverse the migrations.
	     */
	    public function down(): void
	    {
	        Schema::dropIfExists('invoices');
	    }	};



