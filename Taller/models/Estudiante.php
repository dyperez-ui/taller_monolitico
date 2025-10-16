<?php
class Estudiante
{
    private $codigo = 0;
    private $nombre = null;
    private $email = null;
    private $programa = null;

    public function get($prop)
    {
        return $this->{$prop};
    }

    public function setId($prop, $value)
    {
        $this->{$prop} = $value;
    }
}