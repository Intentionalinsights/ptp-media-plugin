<?php

namespace PTP\Media;


class AdminController
{
    private $_get;

    private $_post;

    /**
     * @var \PTP\Media\Repository
     */
    private $repository;

    public function __construct($_get, $_post, $repository)
    {
        $this->_get  = $_get;
        $this->_post = $_post;

        $this->repository = $repository;
    }

    public function __invoke()
    {

        // Default action: list media entries
        $this->defaultAction();
    }

    private function defaultAction()
    {
        $entries = $this->repository->findAll();

        include __DIR__ . '/../templates/admin-list.php';
    }
}
