<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
   protected $table         = 'users';
   protected $allowedFields = ['nama', 'email', 'password','foto_profil'];
   protected $useTimestamps = true;

   public function findByEmail(string $email)
   {
       return $this->where('email', $email)->first();
   }
}
