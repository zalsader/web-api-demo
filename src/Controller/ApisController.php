<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Apis Controller
 *
 *
 * @method \App\Model\Entity\Api[] paginate($object = null, array $settings = [])
 */
class ApisController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $apis = $this->paginate($this->Apis);

        $this->set(compact('apis'));
        $this->set('_serialize', ['apis']);
    }

    /**
     * View method
     *
     * @param string|null $id Api id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $api = $this->Apis->get($id, [
            'contain' => []
        ]);

        $this->set('api', $api);
        $this->set('_serialize', ['api']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $api = $this->Apis->newEntity();
        if ($this->request->is('post')) {
            $api = $this->Apis->patchEntity($api, $this->request->getData());
            if ($this->Apis->save($api)) {
                $this->Flash->success(__('The api has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The api could not be saved. Please, try again.'));
        }
        $this->set(compact('api'));
        $this->set('_serialize', ['api']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Api id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $api = $this->Apis->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $api = $this->Apis->patchEntity($api, $this->request->getData());
            if ($this->Apis->save($api)) {
                $this->Flash->success(__('The api has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The api could not be saved. Please, try again.'));
        }
        $this->set(compact('api'));
        $this->set('_serialize', ['api']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Api id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $api = $this->Apis->get($id);
        if ($this->Apis->delete($api)) {
            $this->Flash->success(__('The api has been deleted.'));
        } else {
            $this->Flash->error(__('The api could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
