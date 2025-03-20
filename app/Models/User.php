<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'email',
        'role',
        'password',
    ];

    protected $hidden = ['password'];

    // Relasi ke Periksa sebagai pasien
    public function periksaSebagaiPasien()
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    // Relasi ke Periksa sebagai dokter
    public function periksaSebagaiDokter()
    {
        return $this->hasMany(Periksa::class, 'id_dokter');
    }
}
