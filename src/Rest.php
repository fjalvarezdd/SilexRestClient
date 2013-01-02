<?php

namespace SilexRestClient\src;

class Rest
{
    protected $ch;
    
    public function __construct($authString=null)
    {
        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        
        if($authString)
        {
            curl_setopt($this->ch, CURLOPT_USERPWD, $authString);
        }
        
        return $this;
    }

    protected function execute()
    {
        $data = curl_exec($this->ch);
        $code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        if($code == 200)
            return $data;
        else
            throw new \Exception('Code returned by the REST process: ' . $code);
    }
    
    public function url($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        
        return $this;
    }

    public function post(array $params)
    {
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, false);

        $this->execute($this->ch);
    }

    public function get()
    {
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

        return $this->execute($this->ch);
    }

}