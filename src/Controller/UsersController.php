<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

  public function beforeFilter(Event $event)
  {
      parent::beforeFilter($event);
      $this->Auth->allow(['login', 'add', 'logout']);
  }

   public function index()
   {
      $this->set('users', $this->Users->find('all'));
  }

  public function view($id)
  {
      $user = $this->Users->get($id);
      $this->set(compact('user'));
  }

  public function add()
  {
      $user = $this->Users->newEntity();
      if ($this->request->is('post')) {
          $user = $this->Users->patchEntity($user, $this->request->data);
          if ($this->Users->save($user)) {
              $this->Flash->success(__("L'utilisateur a été sauvegardé."));
              return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__("Impossible d'ajouter l'utilisateur."));
      }
      $this->set('user', $user);
  }

  public function login()
  {
    if ($this->request->is('post')) {
      $user = $this->Auth->identify();
      if ($user) {
          $this->Auth->setUser($user);
          return $this->redirect($this->Auth->redirectUrl());
      }
      else {
        $this->Flash->error(__('Nom d\'utilisateur ou mot de passe incorrect'), [
          'key' => 'auth'
        ]);
      }
    }
  }

  public function logout()
  {
    $this->redirect($this->Auth->logout());
  }
}
?>
