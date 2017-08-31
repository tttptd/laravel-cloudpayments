<?php

namespace Tttptd\LaravelCloudpayments;

use CloudPayments\Manager;

class CloudpaymentsManager extends Manager
{

    /**
     * @var array
     */
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;

        parent::__construct($config['publicId'], $config['apiPassword'], true);
    }

    public function getTaxationSystem()
    {
        return $this->config['taxationSystem'];
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return array
     */
    protected function sendRequest($endpoint, array $params = [])
    {
        $params['CultureName'] = $this->locale;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url . $endpoint);
        curl_setopt($curl, CURLOPT_USERPWD, sprintf('%s:%s', $this->publicKey, $this->privateKey));
        curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params)); // <-- override for fix that (Exception: Array to String)
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $this->enableSSL);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->enableSSL);

        $result = curl_exec($curl);

        curl_close($curl);

        return (array)json_decode($result, true);
    }

}
