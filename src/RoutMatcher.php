<?php
readonly class RoutMatcher
{
    public function __construct(private RoutCollection $collection)
    {

    }
    public function match(string $url): Route
    {
        foreach ($this->collection->get_routs() as $route) {
            if ($route->getUrl() === $url) {
                return $route;
            }
        }
        throw new Exception('Routs not found');
    }
}