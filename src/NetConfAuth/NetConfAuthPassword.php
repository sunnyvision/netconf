<?php namespace Lamoni\NetConf\NetConfAuth;

use phpseclib\Net\SSH2;

/**
 * Class NetConfAuthPassword
 * @package Lamoni\NetConf\NetConfAuth
 */
class NetConfAuthPassword extends NetConfAuthAbstract
{
    /**
     *Performs the authentication check for this auth type
     *
     * @param SSH2 $ssh
     * @throws \Exception
     */
    public function login(SSH2 &$ssh)
    {
        $this->validateAuthParams(
            $this->authParams,
            $acceptableParams = [
                'username' => 'is_string',
                'password' => 'is_string'
            ]
        );

        extract($this->authParams);

        if (!$ssh->login($username, $password)) {
            throw new \Exception(get_class().': Authentication failed');
        }
    }
}