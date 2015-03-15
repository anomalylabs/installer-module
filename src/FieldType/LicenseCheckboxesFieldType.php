<?php namespace Anomaly\InstallerModule\FieldType;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;

/**
 * Class LicenseCheckboxesFieldType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Addon\FieldType
 */
class LicenseCheckboxesFieldType extends CheckboxesFieldType
{

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.module.installer::addon/field_type/license/input';

    /**
     * The wrapper view.
     *
     * @var string
     */
    protected $wrapperView = 'anomaly.module.installer::addon/field_type/license/wrapper';

}
