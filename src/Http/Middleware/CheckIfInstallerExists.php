<?php namespace Anomaly\InstallerModule\Http\Middleware;

use Anomaly\Streams\Platform\Message\MessageBag;
use Closure;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

/**
 * Class CheckIfInstallerExists
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CheckIfInstallerExists
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The session store.
     *
     * @var Store
     */
    protected $session;

    /**
     * The message bag.
     *
     * @var MessageBag
     */
    protected $messages;

    /**
     * Create a new CheckIfInstallerExists instance.
     *
     * @param Repository $config
     * @param Store      $session
     * @param MessageBag $messages
     */
    public function __construct(Repository $config, Store $session, MessageBag $messages)
    {
        $this->config   = $config;
        $this->session  = $session;
        $this->messages = $messages;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            $request->path() == 'admin' &&
            !$this->session->get(__CLASS__ . 'warned') &&
            !$this->config->get('app.debug')
        ) {
            $this->session->set(__CLASS__ . 'warned', true);
            $this->messages->error('anomaly.module.installer::message.delete_installer');
        }

        return $next($request);
    }
}
