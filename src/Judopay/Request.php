<?php

namespace Judopay;

use Guzzle\Plugin\Log\LogPlugin;

class Request
{
	protected $configuration;
	protected $client;

	public function __construct(\Judopay\Configuration $configuration = null)
	{
		$this->configuration = $configuration;
	}

	public function setClient(\Guzzle\Http\Client $client)
	{
		$this->client = $client;
		print_r($this->configuration->getAll());
		// Set headers
		$this->client->setDefaultOption(
			'headers',
			array(
				'API-Version' => $this->configuration->get('api_version'),
        		'Accept' => 'application/json; charset=utf-8',
        		'Content-Type' => 'application/json'
			)
		);
		$this->client->addSubscriber(LogPlugin::getDebugPlugin());
	}

	public function get($resourcePath)
	{
		$endpointUrl = $this->configuration->get('endpoint_url');
		$request = $this->client->get($endpointUrl.'/'.$resourcePath);
		$request->setAuth(
			$this->configuration->get('api_token'),
			$this->configuration->get('api_secret')
		);

		$response = $request->send();

		return $response;
	}
}