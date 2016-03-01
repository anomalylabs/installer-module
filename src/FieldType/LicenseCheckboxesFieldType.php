<?php namespace Anomaly\InstallerModule\FieldType;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;

/**
 * Class LicenseCheckboxesFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\InstallerModule\Addon\FieldType
 */
class LicenseCheckboxesFieldType extends CheckboxesFieldType
{

    /**
     * The wrapper view.
     *
     * @var string
     */
    protected $wrapperView = 'anomaly.module.installer::addon/field_type/license/wrapper';

}
