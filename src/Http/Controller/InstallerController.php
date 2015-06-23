<?php namespace Anomaly\InstallerModule\Http\Controller;

use Anomaly\InstallerModule\Form\InstallerFormBuilder;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class InstallerController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Http\Controller
 */
class InstallerController extends PublicController
{

    use DispatchesCommands;

    /**
     * Create a new InstallerController instance.
     *
     * @param InstallerFormBuilder $form
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(InstallerFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Run installation.
     *
     * @return \Illuminate\View\View
     */
    public function install(ModuleCollection $modules, ExtensionCollection $extensions)
    {
        $steps = [
            url('installer/command/ClearCache')        => trans('anomaly.module.installer::install.clear_cache'),
            url('installer/command/InstallBaseTables') => trans('anomaly.module.installer::install.base_tables'),
            url('installer/command/CreateApplication') => trans('anomaly.module.installer::install.application')
        ];

        $modules->forget('anomaly.module.installer');

        /* @var Module $module */
        foreach ($modules as $module) {
            $steps[url('installer/module/' . $module->getNamespace())] = trans(
                'anomaly.module.installer::install.module',
                ['name' => strtolower(trans($module->getName()))]
            );
        }

        if (env('INSTALL_SEEDS', false)) {
            foreach ($modules as $module) {
                $steps[url('installer/seed/' . $module->getNamespace())] = trans(
                    'anomaly.module.installer::install.seed',
                    ['name' => strtolower(trans($module->getName()))]
                );
            }
        }

        /* @var Extension $extension */
        foreach ($extensions as $extension) {
            $steps[url('installer/extension/' . $extension->getNamespace())] = trans(
                'anomaly.module.installer::install.extension',
                ['name' => strtolower(trans($extension->getName()))]
            );
        }

        $steps = array_merge(
            $steps,
            [
                url('installer/command/UpdateEnvironmentFile') => trans(
                    'anomaly.module.installer::install.update_environment_file'
                ),
                url('installer/command/CreateAdminUser')       => trans(
                    'anomaly.module.installer::install.create_admin_user'
                ),
                url('installer/command/CreateAdminRole')       => trans(
                    'anomaly.module.installer::install.create_admin_role'
                ),
                url('installer/command/CreateUserRole')        => trans(
                    'anomaly.module.installer::install.create_user_role'
                )
            ]
        );

        return view('anomaly.module.installer::install', compact('steps'));
    }

    /**
     * Run an installation command.
     *
     * @param $command
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function command($command)
    {
        set_time_limit(5000);

        $command = '\Anomaly\InstallerModule\Command\\' . $command;

        $this->dispatch(new $command);

        return response()->json(true);
    }

    /**
     * Install a module.
     *
     * @param ModuleCollection $modules
     * @param ModuleManager    $manager
     * @param                  $module
     */
    public function module(ModuleCollection $modules, ModuleManager $manager, $module)
    {
        set_time_limit(5000);

        $manager->install($modules->get($module));

        return response()->json(true);
    }

    /**
     * Seed a module.
     *
     * @param ModuleCollection $modules
     * @param ModuleManager    $manager
     * @param                  $module
     */
    public function seed(ModuleCollection $modules, Kernel $console, $module)
    {
        set_time_limit(5000);

        $module = $modules->get($module);

        $console->call('db:seed', ['--force' => true, '--addon' => $module->getNamespace()]);

        return response()->json(true);
    }

    /**
     * Install an extension.
     *
     * @param ExtensionCollection $extensions
     * @param ExtensionManager    $manager
     * @param                     $extension
     */
    public function extension(ExtensionCollection $extensions, ExtensionManager $manager, $extension)
    {
        set_time_limit(5000);
        
        $manager->install($extensions->get($extension));

        return response()->json(true);
    }
}
 