<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $fillable = [
            'nama_kota',
            'pulau_id',
            'provinsi_id',
            'luar_negeri' ,
            'lat',
            'long'
        ];
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    public function pulau()
    {
        return $this->belongsTo(Pulau::class);
    }
}
