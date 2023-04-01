<?php

use App\Models\Resident;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('code_operation',45);
            $table->date('date_operation');
            $table->decimal('amount',12,2);
            $table->string('payment_method');
            $table->string('payment_document',255)->nullable();
            $table->foreignId('resident_id');
            $table->foreignId('syndicate_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
};
