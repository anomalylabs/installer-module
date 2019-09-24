<?php namespace Anomaly\InstallerModule\Http\Middleware;

use Anomaly\Streams\Platform\Message\MessageBag;
use Closure;
use Illuminate\Http\Request;

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
     * The message bag.
     *
     * @var MessageBag
     */
    protected $messages;

    /**
     * Create a new CheckIfInstallerExists instance.
     *
     * @param MessageBag $messages
     */
    public function __construct(MessageBag $messages)
    {
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
            !session(__CLASS__ . 'warned') &&
            !config('app.debug')
        ) {
            session([__CLASS__ . 'warned' => true]);
            $this->messages->error('anomaly.module.installer::message.delete_installer');
        }

        return $next($request);
    }
}
