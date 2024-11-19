<?php
Class RoutCollection
{
    private array $array_routs = [];

    public function add(Route $route): self
    {
        $this->array_routs[] = $route;
        return $this;
    }

    public function get_routs(): array
    {
        return $this->array_routs;
    }
}