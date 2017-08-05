<?php
namespace App\Controller;

use App\Controller\AppController;
use Aura\Intl\Exception;
use Cake\Core\Configure;
use Cake\Log\Log;
use Facebook\Facebook;

/**
 * Apis Controller
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

    }

    public function fbupload()
    {
        if ($this->request->is('post')) {
            $fb = new Facebook([
                'app_id' => Configure::read('Facebook.appId'),
                'app_secret' => Configure::read('Facebook.secret'),
                'default_graph_version' => Configure::read('version'),
                'default_access_token' => $this->request->getData('fbtoken'),
            ]);
            try {
                $photo = $this->request->getData('photo');
                $response = $fb->post('/me/photos', [
                    'message' => $this->request->getData('caption'),
                    'source' => $fb->fileToUpload($photo['tmp_name'])
                ]);
                $photoNode = $response->getGraphNode();
                $this->Flash->success('Photo created successfully, ID:' . $photoNode['id']);
            } catch (Exception $e) {

            }
        }
    }

    public function subscribe()
    {
        if ($this->request->is('get')) {
            if ($this->request->getQuery('hub_mode') == 'subscribe' && $this->request->getQuery('hub_verify_token')) {
                $this->response = $this->response->withStringBody($this->request->getQuery('hub_challenge'));
            }
        } else {
            $request = $this->request->input('json_decode');
            Log::debug(json_encode($request));
        }
    }
}
