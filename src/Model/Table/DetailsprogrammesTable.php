<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class DetailsprogrammesTable extends Table {
  public function initialize(array $config)
   {
       $this->belongsTo('Programmes', [
         'foreignKey' => 'programme_id'
       ]);
   }
}
 ?>
