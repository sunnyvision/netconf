<?php namespace Lamoni\NetConf\NetConfAuth;

use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;

/**
 * Class NetConfAuthRSAString
 * @package Lamoni\NetConf\NetConfAuth
 */
class NetConfAuthRSAString extends NetConfAuthAbstract
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
                'rsastring' => 'is_string'
            ]
        );

        extract($this->authParams);

        $rsakey = new RSA();

        $rsakey->loadKey($rsastring);

        if (!$ssh->login($username, $rsakey)) {
            throw new \Exception(get_class().': Authentication failed');
        }
    }
}