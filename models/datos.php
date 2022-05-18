<?php

class Datos
{
    private $id;
    private $ip;
    private $hostname;
    private $city;
    private $region;
    private $country;
    private $loc;
    private $org;
    private $timezone;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __construc()
    {
        $this->id = 0;
        $this->ip = "x";
        $this->hostname = "x";
        $this->city = "x";
        $this->region = "x";
        $this->country = "x";
        $this->loc = "x";
        $this->org = "x";
        $this->timezone = "x";
    }
}
