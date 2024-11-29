<?php

namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model
{
  protected $table      = 'ci4_board';
  protected $primaryKey = 'bid';
  protected $useAutoIncrement = true;
  protected $returnType     = 'object';
  protected $allowedFields = [
    'userid', 'subject', 'content','regdate'
  ];
}