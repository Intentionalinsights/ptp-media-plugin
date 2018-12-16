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

        if (isset($this->_get['ptp-action'])) {

            $action = $this->_get['ptp-action'];

            if ($action === 'newMedia') {
                $this->newMediaAction();

                return;
            }

            if ($action === 'saveMedia') {
                $this->saveMediaAction();

                return;
            }

            if ($action === 'editMedia') {
                $this->editMediaAction();

                return;
            }
        }

        // Default action: list media entries
        $this->defaultAction();
    }

    private function defaultAction()
    {
        $entries = $this->repository->findAll();

        include __DIR__ . '/../templates/admin-list.php';
    }

    private function newMediaAction()
    {
        $entry = new Entry(['active' => 1]);

        $titleAction = "Create New";

//        $errors = ['title' => 'The title is needed', 'date' => 'The date doesn\'t appear to be valid', 'url' => 'The url doesn\'t appear to be valid.'];
        include __DIR__ . '/../templates/form.php';
    }

    private function saveMediaAction()
    {
        $entry = new Entry();

        $mediaId = $this->_post['media-id'];

        if ($mediaId) {
            $entry = $this->repository->find($mediaId);
        }

        $entry->hydrate($this->_post);

        if (!$entry->isValid()) {
            $errors = $entry->errors();

            $errors['save'] = "Unable to save the media entry";

            include __DIR__ . '/../templates/form.php';

            return;
        }

        if (!$this->repository->save($entry)) {
            $errors['save'] = "Unable to save the media entry";

            include __DIR__ . '/../templates/form.php';

            return;
        }

        echo "<script>window.location.href='?page=ptp_media';</script>";
    }

    private function editMediaAction()
    {
        $mediaId = $this->_get['media-id'];
        $entry = $this->repository->find($mediaId);

        $titleAction = "Edit";

        include __DIR__ . '/../templates/form.php';
    }
}
