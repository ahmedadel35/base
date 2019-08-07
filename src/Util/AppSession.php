<?php declare (strict_types=1);

namespace App\Util;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Util\Password;
use Symfony\Component\HttpFoundation\Request;

class AppSession
{
    const CHECK_IP_ADDRESS = false; // check if user changed ip
    const CHECK_BROWSER = true; // check if user changed browser
    // const SAME_SITE = 'Strict'; // or lax for more than one domain
    const SESSION_MAXLIFE = 1800; // 1800 sec ==> 30 min
    // const Strict_MODE = 1; // or 0

    /**
     * Request Instance
     *
     * @var Request
     */
    private $request;
    /**
     * Session Instance
     *
     * @var Session
     */
    public $se;

    public function __construct(
        SessionInterface $session,
        Request $request
        ) {
        $this->se = $session;
        $this->request = $request;
    }

    public function sessStart() : void
    {
        $this->se->start();

        // check prevent multible ip and browser
        // session is created
        if ((self::CHECK_BROWSER || self::CHECK_IP_ADDRESS)
        && !$this->preventMultiIP()) {
            // destory session
            $this->se->invalidate();

            if (self::CHECK_IP_ADDRESS) $this->setUserIP();
            if (self::CHECK_BROWSER) $this->setUserAgent();
        }

        // check session active time
        $this->checkActivity();

        // set the csrf token
        $this->setCsrfToken();
    }

    /**
     * set the csrf token to random string
     *
     * @return void
     */
    private function setCsrfToken() : void
    {
        // check for general purpose token
        if (!$this->se->has('X_CSRF_TOKEN')) {
            // default length is 48
            $this->se->set('X_CSRF_TOKEN', Password::randStr());
        }

        // add an per-form csrf token
        if (!$this->se->has('Form_Token')) {
            $this->se->set('Form_Token', Password::randStr());
        }
    }

    private function setUserIP() : void
    {
        $this->se->set('userIP', $this->encode('REMOTE_ADDR'));
    }

    private function getUserIP() : ?string
    {
        return $this->se->get('userIP');
    }

    private function setUserAgent() : void
    {
        $this->se->set('userAgent', $this->encode('HTTP_USER_AGENT'));
    }

    private function getUserAgent() : ?string
    {
        return $this->se->get('userAgent');
    }

    /**
     * hash server attributes to check if session hijaked
     *
     * @param string $server_attr
     * @return string
     */
    private function encode(string $server_attr) : string
    {
        return Password::hashMac(
            $this->request->server->get($server_attr),
            '41c6dee3uX0E2hwmpVKuqbyIkbs43GN9QLW41u3y'
        );
    }

    private function checkActivity() : void
    {
        if (time() - $this->se->getMetadataBag()->getLastUsed() > self::SESSION_MAXLIFE) {
            $this->se->invalidate();
            throw new Exception('session distroyed');
        }
    }

    private function preventMultiIP() : bool
    {
        if (!$this->se->has('userIP')
        && !$this->se->has('userAgent')) {
            return false;
        }

        // check for ip address
        if (self::CHECK_IP_ADDRESS
        && (!Password::hashVerify($this->getUserIP(), $this->encode('REMOTE_ADDR')))) {
            return false;
        }

        // check for user browser
        if (self::CHECK_BROWSER
        && (!Password::hashVerify($this->getUserAgent(), $this->encode('HTTP_USER_AGENT'))) ) {
            return false;
        }

        return true;
    }
    
}