<?php namespace App\Models;

use CodeIgniter\Model;

class Mdl_data_toko extends Model
{
    protected $table      = 'info_toko';
    protected $primaryKey = 'id';
    protected $useTimestamps = TRUE;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['nama', 'alamat','logo','deskripsi_toko'];

}
