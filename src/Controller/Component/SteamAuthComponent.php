<?php
/**
 * This is a implementation of the Steam login
 *
 * @author Flavio Kleiber <zerbarian@gmail.com>
 * @copyright (c) Flavio Kleiber 2017
 */
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class SteamAuthComponent extends Component {

  const CREATION = 0;
  const RELATION = 1;

  public $components = ['Flash', 'Auth'];
  /**
   * Connect to steam
   *
   * @return User|null if the connection was success full
   */
  public function connect($mode = self::CREATION)
  {
    $apiKey = Configure::read('Steam.api_key');
    $url = Configure::read('Steam.url');
    $userTable = TableRegistry::get('Users');
    $controller = $this->_registry->getController();

    $openid = new \LightOpenID($url);

    if(!$openid->mode) {
      $openid->identity = 'http://steamcommunity.com/openid/?l=english';
      header('Location: ' . $openid->authUrl());
      exit();
    } else if($this->mode == 'cancel') {
      $controller->redirect('/sing-up');
    } else {
      if($openid->validate()) {
        $id = $openid->identity;
        // identity is something like: http://steamcommunity.com/openid/id/76561197960435530
        // we only care about the unique account ID at the end of the URL.
        $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
        preg_match($ptn, $id, $matches);

        $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apiKey&steamids=$matches[1]";
        $json_object= file_get_contents($url);
        $json_decoded = json_decode($json_object);
        $newPlayer = null;
        foreach ($json_decoded->response->players as $player) {
          $newPlayer = $player;
        }

        $user = $userTable->newEntity();

        if($mode == self::CREATION || $mode == self::RELATION) {
          $user->username = $newPlayer->personaname;
          $user->password = ' ';
          $user->steamid = $newPlayer->steamid;
          $user->steamavatar = $newPlayer->avatarfull;
          $user->isValid = 1;
          if($userTable->save($user)) {
            $this->Auth->setUser($user);
            $this->Flash->success('Connection done!');
            $controller->redirect($this->Auth->redirectUrl());
          }
        } else {
          throw new \Exception('STEAM-API: NO VALID MODE GIVEN!', 1518440049);
        }
      }
    }
  }
}
