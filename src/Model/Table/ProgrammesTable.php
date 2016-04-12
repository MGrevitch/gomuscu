<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProgrammesTable extends Table {
  public function initialize(array $config)
   {
       $this->belongsTo('Users', [
         'foreignKey' => 'user_id'
       ]);

       $this->hasMany('Detailsprogrammes', [
         'foreignKey' => 'programme_id',
         'dependent' => true,
         'cascadeCallbacks' => true
       ]);
   }

   public function validationDefault(Validator $validator)
   {
       return $validator
        ->notEmpty('nom', "Un nom de programme doit être saisi");
   }
}
 ?>
