<?php
readonly class Route
{

    public function __construct (private string $url,
                                 private string $method,
                                 private string $class,
                                 private string $class_method)
    {


    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getClassMethod(): string
    {
        return $this->class_method;
    }



}