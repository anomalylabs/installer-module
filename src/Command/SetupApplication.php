<?php namespace Anomaly\InstallerModule\Command;

/**
 * Class SetupApplication
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Command
 */
class SetupApplication
{

    /**
     * The parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create a new SetupApplication instance.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Get the parameters.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
