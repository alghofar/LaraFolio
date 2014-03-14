<?php namespace Tyloo\Services\Forms;

use Illuminate\Auth\AuthManager;
use Illuminate\Config\Repository;

class ProfileForm extends AbstractForm
{
    /**
     * Config repository instance.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Auth manager instance.
     *
     * @var \Illuminate\Auth\AuthManager
     */
    protected $auth;

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'first_name' => 'min:2',
        'last_name' => 'min:2',
        'location' => 'min:2',
        'description' => 'min:2',
    ];

    /**
     * Create a new SettingsForm instance.
     *
     * @param  \Illuminate\Config\Repository $config
     * @param  \Illuminate\Auth\AuthManager  $auth
     * @return void
     */
    public function __construct(Repository $config, AuthManager $auth)
    {
        parent::__construct();

        $this->config = $config;
        $this->auth = $auth;
    }

    /**
     * Get the prepared validation rules.
     *
     * @return array
     */
    protected function getPreparedRules()
    {
        return $this->rules;
    }

    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'first_name', 'last_name', 'location', 'description'
        ]);
    }

}
