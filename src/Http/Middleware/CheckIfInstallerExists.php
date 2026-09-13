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
     * The session key marking an installation in progress.
     *
     * @var string
     */
    const STARTED = 'anomaly.module.installer::started';

    /**
     * The number of seconds an unfinished
     * installation may be resumed for.
     *
     * @var integer
     */
    const RESUME_WINDOW = 3600;

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
        if ($request->segment(1) == 'installer') {

            if (!$this->config->get('streams::system.installed')) {
                $this->session->put(self::STARTED, time());
            } elseif (!$this->resuming()) {
                abort(404);
            }

            return $next($request);
        }

        if (
            $request->path() == 'admin' &&
            !$this->session->get(__CLASS__ . 'warned') &&
            !$this->config->get('app.debug')
        ) {
            $this->session->put(__CLASS__ . 'warned', true);
            $this->messages->error('anomaly.module.installer::message.delete_installer');
        }

        return $next($request);
    }

    /**
     * An installation writes INSTALLED=true partway through its
     * own sequence and then keeps running, so a run started
     * before that point is allowed to finish.
     *
     * @return bool
     */
    protected function resuming()
    {
        if (!$started = $this->session->get(self::STARTED)) {
            return false;
        }

        return time() - $started < self::RESUME_WINDOW;
    }
}
