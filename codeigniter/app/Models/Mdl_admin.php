<?php namespace App\Models;

use CodeIgniter\Model;

class Mdl_admin extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';
    protected $useTimestamps = TRUE;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['username', 'password','level'];
    function test(){
        
    }

}