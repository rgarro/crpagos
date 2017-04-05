<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Mailer Controller
 *
 * @property \App\Model\Table\MailerTable $Mailer
 */
class MailerController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $mailer = $this->paginate($this->Mailer);

        $this->set(compact('mailer'));
        $this->set('_serialize', ['mailer']);
    }

    /**
     * View method
     *
     * @param string|null $id Mailer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mailer = $this->Mailer->get($id, [
            'contain' => []
        ]);

        $this->set('mailer', $mailer);
        $this->set('_serialize', ['mailer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mailer = $this->Mailer->newEntity();
        if ($this->request->is('post')) {
            $mailer = $this->Mailer->patchEntity($mailer, $this->request->getData());
            if ($this->Mailer->save($mailer)) {
                $this->Flash->success(__('The mailer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mailer could not be saved. Please, try again.'));
        }
        $this->set(compact('mailer'));
        $this->set('_serialize', ['mailer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Mailer id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mailer = $this->Mailer->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mailer = $this->Mailer->patchEntity($mailer, $this->request->getData());
            if ($this->Mailer->save($mailer)) {
                $this->Flash->success(__('The mailer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mailer could not be saved. Please, try again.'));
        }
        $this->set(compact('mailer'));
        $this->set('_serialize', ['mailer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mailer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mailer = $this->Mailer->get($id);
        if ($this->Mailer->delete($mailer)) {
            $this->Flash->success(__('The mailer has been deleted.'));
        } else {
            $this->Flash->error(__('The mailer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
