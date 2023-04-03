<?php namespace Anomaly\InstallerModule\Installer\Form;

use Anomaly\Streams\Platform\View\Command\GetLayoutName;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class InstallerFormOptions
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class InstallerFormOptions
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param InstallerFormBuilder $builder
     */
    public function handle(InstallerFormBuilder $builder)
    {
        $builder->setOptions(
            [
                'layout_view' => $this->dispatchSync(new GetLayoutName('installer', 'anomaly.module.installer::layouts/installer')),
                'breadcrumb'  => 'anomaly.module.installer::breadcrumb.install',
            ]
        );
    }
}
