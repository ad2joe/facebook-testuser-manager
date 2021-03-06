<?php

namespace App\Action;

class AjaxUserFriendsAction extends Base
{

	public function run()
	{

		try{
            
            //Get list of users
            $fb = $this->getFacebookClient();

            //Get Input Params
            $uid = $this->getInspekt()->post->getAlnum('uid');
            $token = $this->getInspekt()->post->getRaw('token');

            //Get extra data
            $fb->setAccessToken($token);
            $friends = $fb->api('/me/friends');

        } catch (\Exception $e) {
            $this->redirectToError($e, true);
            return;
        }

        $response = new \App\JsonResponse(200, null, $friends['data']);
        $response->sendOutput();
	}

}

?>