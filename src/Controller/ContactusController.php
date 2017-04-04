<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contactus Controller
 *
 * @property \App\Model\Table\ContactusTable $Contactus
 */
class ContactusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contactus = $this->paginate($this->Contactus);

        $this->set(compact('contactus'));
        $this->set('_serialize', ['contactus']);
    }

    /**
     * View method
     *
     * @param string|null $id Contactus id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactus = $this->Contactus->get($id, [
            'contain' => []
        ]);

        $this->set('contactus', $contactus);
        $this->set('_serialize', ['contactus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactus = $this->Contactus->newEntity();
        if ($this->request->is('post')) {
            $contactus = $this->Contactus->patchEntity($contactus, $this->request->getData());
            if ($this->Contactus->save($contactus)) {
                $this->Flash->success(__('The contactus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contactus could not be saved. Please, try again.'));
        }
        $this->set(compact('contactus'));
        $this->set('_serialize', ['contactus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contactus id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactus = $this->Contactus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactus = $this->Contactus->patchEntity($contactus, $this->request->getData());
            if ($this->Contactus->save($contactus)) {
                $this->Flash->success(__('The contactus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contactus could not be saved. Please, try again.'));
        }
        $this->set(compact('contactus'));
        $this->set('_serialize', ['contactus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contactus id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactus = $this->Contactus->get($id);
        if ($this->Contactus->delete($contactus)) {
            $this->Flash->success(__('The contactus has been deleted.'));
        } else {
            $this->Flash->error(__('The contactus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
