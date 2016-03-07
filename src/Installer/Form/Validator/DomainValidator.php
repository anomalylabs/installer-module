<?php namespace Anomaly\InstallerModule\Installer\Form\Validator;

use Illuminate\Contracts\Config\Repository;

/**
 * Class DomainValidator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\InstallerModule\Installer\Form\Validator
 */
class DomainValidator
{

    /**
     * Handle the validation.
     *
     * @param Repository $config
     * @param            $value
     * @return bool
     */
    public function handle(Repository $config, $value)
    {
        $url  = parse_url($value);
        $host = array_get($url, 'host');

        $pattern = '/^(' . implode('|', array_keys($config->get('streams::locales.supported'))) . ')(\.)./';

        return !$host || !preg_match($pattern, $host, $matches);
    }
}
