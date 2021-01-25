<?php namespace App\Models;
use Bcrypt\Bcrypt;
use CodeIgniter\Model;

class Mdl_admin extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';
    protected $useTimestamps = TRUE;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['username', 'password','nama_depan','nama_belakang','level'];

    function get_cipherpass($username){
      return $this->where(['username'=>$username, 'deleted_at'=>NULL])->first('password','username','level','nama_depan','nama_belakang');
    }

}
