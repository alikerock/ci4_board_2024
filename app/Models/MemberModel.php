<?php

namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model
{
  protected $table      = 'ci4_members';
  protected $primaryKey = 'idx';
  protected $useAutoIncrement = true;
  protected $returnType     = 'object';
  protected $allowedFields = [
    'userid', 'email', 'username','passwd','regdate','level','last_login','end_login_date'
  ];
}