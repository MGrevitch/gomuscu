<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class ProgrammesController extends AppController
{
  public function index($id = null)
  {
    $user = $this->Auth->user('id');
    $programmes = TableRegistry::get('Programmes');
    $choixProg = $this->Programmes->newEntity();
    $afficherProgBase = false; //Si la variable est sur true alors on affichera le programme de base

    //Liste des programmes d'un utilisateur
    $reqListeProg = $programmes->find('list', [
    'keyField' => 'id',
    'valueField' => 'nom'])
      ->where(['user_id' => $user]);
    $listeProg = $reqListeProg->toArray();

    //Cas où un programme est choisi
    if($this->request->is('post')) {
      //On cherche le programme choisi, on vérifie si il appartient à l'user puis on l'affiche
      $progChoisi = $this->request->data['programmeChoisi'];
      $verifChoixProg = $programmes->get($progChoisi);
      if($verifChoixProg->user_id == $user) {
          $rechercheProg = $programmes->find()->contain([
            'Detailsprogrammes' => function ($q) {
              return $q;
            }
          ]);
          $rechercheProg->where(['Programmes.id' => $progChoisi]);
      }
      else {
        //Si le programme n'appartient pas à l'user alors on rend $afficherProgBase vrai pour afficher le programme de base
        $afficherProgBase = true;
        $this->Flash->error(__('Vous tentez d\'accèder à une programme qui n\'est pas à vous'));
      }
    }

    elseif(!$this->request->is('post') OR $afficherProgBase) {
      //recherche du 1er programme appartenant à l'utilisateur
      $rechercheProg = $programmes->find()->contain([
        'Detailsprogrammes' => function ($q) {
           return $q;
          }
      ]);
      $rechercheProg->where(['Programmes.user_id' => $user])
        ->limit(1);
    }

    //Transmission à la vue
    $data = [
      'programmes' => $rechercheProg,
      'listeProg' => $listeProg,
      'choixProg' => $choixProg
    ];
    $this->set($data);


  }

  public function delete($id)
  {
    $user = $this->Auth->user('id');
    $programmes = TableRegistry::get('Programmes');

    //Vérifie qu'il y ait un programme à ce numéro -- Evite l'erreur 500
    $existenceProg = $programmes->find('all')
      ->where(['id' => $id]);
    $existenceProg = $existenceProg->count();

    if($existenceProg > 0) {
      $delProg = $programmes->get($id);

      //Vérifie si le programme appartient à l'user
      if($delProg->user_id == $user) {
        $programmes->delete($delProg);
        $this->Flash->success(__('Ce programme a été supprimé avec succès'));
      }
      else {
        $this->Flash->error(__('Ce programme ne vous appartient pas'));
      }
    }
    else {
      $this->Flash->error(__('Ce programme n\'existe pas'));
    }
    return $this->redirect(['action' => 'index']);
  }


  public function add()
  {
    $user = $this->Auth->user('id');
    $programmes = TableRegistry::get('Programmes');


    //Liste des exercices disponibles
    $this->loadModel('Exercices');
    $reqListeExos = $this->Exercices->find('all');
    foreach($reqListeExos as $reqlisteExo):
      $listeExo[$reqlisteExo['denomination']] = $reqlisteExo['denomination'];
      $listeExoJs[] = $reqlisteExo['denomination']; //Permet le transfert de l'array du Php vers JS par le JSON
    endforeach;

    if($this->request->is('post')) {
      $programme = $programmes->newEntity($this->request->data, [
        'associated' => ['Detailsprogrammes']
      ]);
      if ($this->Programmes->save($programme)) {
          $this->Flash->success(__("Le programme a été enregistré"));
      }
      else {
        $this->Flash->error(__("Une erreur est survenue lors de l'enregistrement"));
      }
      return $this->redirect(['action' => 'index']);
    }


    //transmission à la vue
    $data = [
      'listeExo' => $listeExo,
      'listeExoJs' => $listeExoJs,
      'user' => $user
    ];
    $this->set($data);
  }

  public function edit($id)
  {
    $user = $this->Auth->user('id');
    $programmes = TableRegistry::get('Programmes');

    $verifOwnerProg = $programmes->get($id);
    if($verifOwnerProg->user_id == $user) {

      //Liste des exercices disponibles
      $this->loadModel('Exercices');
      $reqListeExos = $this->Exercices->find('all');
      foreach($reqListeExos as $reqlisteExo):
        $listeExo[$reqlisteExo['denomination']] = $reqlisteExo['denomination'];
        $listeExoJs[] = $reqlisteExo['denomination']; //Permet le transfert de l'array du Php vers JS par le JSON
      endforeach;

      //Recherche des données du programme à modifier
      $programmeAModifier = $programmes->find('all', ['contain' => 'Detailsprogrammes']);
      $programmeAModifier->where(['id' => $id]);


      //Transmission à la vue
      $data = [
        'listeExo' => $listeExo,
        'listeExoJs' => $listeExoJs,
        'user' => $user,
        'programmeAModifier' => $programmeAModifier
      ];

      $this->set($data);
    }
  }
}
?>
