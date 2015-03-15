<?php namespace Anomaly\InstallerModule\Form\Command;

use Illuminate\Support\Collection;

/**
 * Class SetFormOptions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\InstallerModule\Form\Command
 */
class SetFormOptions
{

    /**
     * The form options.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $options;

    /**
     * Create a new SetFormOptions instance.
     *
     * @param Collection $options
     */
    public function __construct(Collection $options)
    {
        $this->options = $options;
    }

    /**
     * Get the form options.
     *
     * @return Collection
     */
    public function getOptions()
    {
        return $this->options;
    }
}
