<?php

namespace PTP\Media;

class Entry
{
    public $id;
    public $title;
    public $url;
    public $active;

    public $created;
    public $edited;

    public function __construct($properties = [])
    {
        if ($properties) {
            $this->hydrate($properties);
        }
    }

    private function hydrate($properties)
    {
        $this->id     = $properties['id']     ?: null;
        $this->title  = $properties['title']  ?: null;
        $this->url    = $properties['url']    ?: null;
        $this->date   = $properties['date']   ?: null;
        $this->active = $properties['active'] ?: null;

        $this->created = $properties['created'] ?: null;
        $this->edited  = $properties['edited']  ?: null;
    }
}
