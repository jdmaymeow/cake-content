<?php
namespace CakeContent\Controller;

use CakeContent\Controller\AppController;

/**
 * Nodes Controller
 *
 * @property \CakeContent\Model\Table\NodesTable $Nodes
 */
class NodesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Terms', 'ParentNodes']
        ];
        $nodes = $this->paginate($this->Nodes);

        $this->set(compact('nodes'));
        $this->set('_serialize', ['nodes']);
    }

    /**
     * View method
     *
     * @param string|null $id Node id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $node = $this->Nodes->get($id, [
            'contain' => ['Users', 'Terms', 'ParentNodes', 'Tags', 'ChildNodes']
        ]);

        $this->set('node', $node);
        $this->set('_serialize', ['node']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $node = $this->Nodes->newEntity();
        if ($this->request->is('post')) {
            $node = $this->Nodes->patchEntity($node, $this->request->data);
            $node->user_id = $this->Auth->user('id');
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The node could not be saved. Please, try again.'));
            }
        }
        $users = $this->Nodes->Users->find('list', ['limit' => 200]);
        $terms = $this->Nodes->Terms->find('list', ['limit' => 200]);
        $parentNodes = $this->Nodes->ParentNodes->find('list', ['limit' => 200]);
        $tags = $this->Nodes->Tags->find('list', ['limit' => 200]);
        $this->set(compact('node', 'users', 'terms', 'parentNodes', 'tags'));
        $this->set('_serialize', ['node']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Node id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $node = $this->Nodes->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $node = $this->Nodes->patchEntity($node, $this->request->data);
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The node could not be saved. Please, try again.'));
            }
        }
        $users = $this->Nodes->Users->find('list', ['limit' => 200]);
        $terms = $this->Nodes->Terms->find('list', ['limit' => 200]);
        $parentNodes = $this->Nodes->ParentNodes->find('list', ['limit' => 200]);
        $tags = $this->Nodes->Tags->find('list', ['limit' => 200]);
        $this->set(compact('node', 'users', 'terms', 'parentNodes', 'tags'));
        $this->set('_serialize', ['node']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Node id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $node = $this->Nodes->get($id);
        if ($this->Nodes->delete($node)) {
            $this->Flash->success(__('The node has been deleted.'));
        } else {
            $this->Flash->error(__('The node could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function tags()
    {
        $tags = $this->request->params['pass'];

        $nodes = $this->Nodes->find('tagged', [
            'tags' => $tags
        ]);

        $this->set([
            'nodes' => $nodes,
            'tags' => $tags
        ]);
    }
}
