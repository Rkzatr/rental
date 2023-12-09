<?php

namespace App\Database\Migrations;

use App\Libraries\DB;
use CodeIgniter\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class Init extends Migration
{
    public function up()
    {
        DB::schema()->create("kategori", function (Blueprint $table) {
            $table->id();
            $table->string("label");
            $table->text("gambar");
            $table->timestamps();
            $table->softDeletes();
        });
        DB::schema()->create("alat", function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("kode");
            $table->unsignedBigInteger("id_kategori");
            $table->text("gambar");
            $table->unsignedBigInteger("harga");
            $table->text("deskripsi");
            $table->timestamps();
            $table->softDeletes();
        });
        DB::schema()->create("rental", function (Blueprint $table) {
            $table->id();
            $table->date("tgl_sewa");
            $table->date("tgl_kembali");
            $table->unsignedBigInteger("status");
            $table->unsignedBigInteger("harga");
            $table->unsignedBigInteger("id_customer");
            $table->unsignedBigInteger("denda");
            $table->timestamps();
            $table->softDeletes();
        });

        DB::schema()->create("rental_detail", function (Blueprint $table) {
            $table->unsignedBigInteger("id_rental");
            $table->unsignedBigInteger("id_alat");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        DB::dropIfExists('kategori');
        DB::dropIfExists('alat');
        DB::dropIfExists('rental');
        DB::dropIfExists('rental_detail');
    }
}
