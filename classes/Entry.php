<?php

namespace PTP\Media;

class Entry
{
    public $id;
    public $title;
    public $url;
    public $date;
    public $active;
    public $description;

    public $created;
    public $edited;

    public function __construct($properties = [])
    {
        if ($properties) {
            $this->hydrate($properties);
        }
    }

    public function hydrate($properties)
    {
        $this->id          = $properties['id']     ?: null;
        $this->title       = $properties['title']  ?: null;
        $this->url         = $properties['url']    ?: null;
        $this->date        = $properties['date']   ?: null;
        $this->active      = $properties['active'] ?: null;
        $this->description = $properties['description'] ?: null;

        $this->created = $properties['created'] ?: null;
        $this->edited  = $properties['edited']  ?: null;
    }

    public function isValid()
    {
        return count($this->errors()) > 0;
    }

    public function errors()
    {
        $errors = [];

        // Title is required
        if (!$this->title) {
            $errors['title'] = "The title is needed";
        }

        // Url is required
        if (!$this->url) {
            $errors['url'] = "The url is needed";
        } elseif (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            $errors['url'] = "The url doesn't appear to be valid";
        }

        // Date is required
        if (!$this->date) {
            $errors['date'] = "The date is needed for proper ordering";
        } elseif (!$this->date === (new \DateTime($this->date))->format('mm/dd/yyyy')) {
            $errors['date'] = "The date doesn't appear to be valid";
        }

        return $errors;
    }
}
