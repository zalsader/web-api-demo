<?php
namespace App\Controller;

use App\Controller\AppController;
use Aura\Intl\Exception;
use Cake\Core\Configure;
use Cake\Log\Log;
use Facebook\Facebook;
use Twilio\Rest\Client;

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
        // TODO check signature
        if ($this->request->is('get')) {
            if ($this->request->getQuery('hub_mode') == 'subscribe' && $this->request->getQuery('hub_verify_token')) {
                $this->response = $this->response->withStringBody($this->request->getQuery('hub_challenge'));
                return $this->response;
            }
        }
        $request = $this->request->input('json_decode');
        Log::debug(json_encode($request));
        foreach ($request['entry'] as $entry) {
            $userId = $entry['uid'];
            $userName = $this->getUserName($userId);
            foreach ($entry['changes'] as $change) {
                if ($change['field'] == 'status') {
                    $message = "Your friend $userName changed his ststus to: " . $change['value'];
                    $this->sendSms('+1 256-567-5764', $message);
                }
            }
        }
        $this->response = $this->response->withStringBody('OK');
        return $this->response;
    }

    private function getUserName($userId) {
        $fb = new Facebook([
            'app_id' => Configure::read('Facebook.appId'),
            'app_secret' => Configure::read('Facebook.secret'),
            'default_graph_version' => Configure::read('version'),
            'default_access_token' => $this->request->getData('fbtoken'),
        ]);

        try {
            $response = $fb->get('/me?fields=id,name');
            $userNode = $response->getGraphUser();
            return $userNode->getName();
        } catch (Exception $e) {
            return 'Unknown';
        }
    }

    private function sendSms($to, $message) {
        $client = new Client(Configure::read('Twilio.accountSid'), Configure::read('Twilio.authToken'));
        $sms = $client->account->messages->create(
            $to,
            array(
                'from' => Configure::read('Twilio.messagingSid'),
                'body' => $message
            )
        );
        return $sms;
    }

    public function sendSmsRequest() {
            $sms = $this->sendSms('+1 256-567-5764', 'Hey Test, Monkey Party at 6PM. Bring Bananas!');
            debug($sms); exit;
    }
}
