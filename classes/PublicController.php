<?php

namespace PTP\Media;


class PublicController
{
    private $_get;

    private $_post;

    /**
     * @var \PTP\Media\Repository
     */
    private $repository;

    public function __construct($_get, $_post, $repository)
    {
        $this->_get       = $_get;
        $this->_post      = $_post;
        $this->repository = $repository;
    }

    public function allMedia()
    {
        ob_start();

        $entries = $this->repository->findAllActive();

        include __DIR__ . '/../templates/public-list.php';

        return ob_get_clean();
    }

    public function latestMedia()
    {
        ob_start();

        $entries = $this->repository->findLatest();

        include __DIR__ . '/../templates/public-list.php';

        return ob_get_clean();
    }
}
