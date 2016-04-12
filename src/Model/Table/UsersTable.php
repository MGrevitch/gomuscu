<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

class UsersTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', "Un nom d'utilisateur est nécessaire")
            ->notEmpty('password', 'Un mot de passe est nécessaire')
            ->notEmpty('email', 'Une adresse email est nécessaire')
            ->add('username', [
                'length' => [
                    'rule' => ['maxLength', 20],
                    'message' => 'Le pseudo doit être inférieur à 20 caractères'
                  ]
            ])
            ->add('password', [
              'length' => [
                  'rule' => ['minLength', 5],
                  'message' => 'Le mot de passe doit contenir au moins 5 caractères'
              ]
            ])
            ->add('email', 'unique', [
              'rule' => 'validateUnique',
              'provider' => 'table',
              'message' => "Email déjà utilisée"
            ])
            ->add('username', 'unique', [
              'rule' => 'validateUnique',
              'provider' => 'table',
              'message' => 'Identifiant déjà utilisé'
            ]);


    }

    public function initialize(array $config)
     {
         $this->hasMany('Programmes');
     }

}
?>
