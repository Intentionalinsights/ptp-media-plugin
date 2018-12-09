<?php

namespace PTP\Media;

class Repository
{
    private $wpdb;

    private $mediaTable;

    public function __construct($wpdb, $mediaTable)
    {
        $this->wpdb       = $wpdb;
        $this->mediaTable = $mediaTable;
    }

    public function find($id)
    {
        $query = "";
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $entries = [];

        $query = "SELECT * FROM {$this->mediaTable} ORDER BY date DESC";

        $results = $this->wpdb->get_results($query, 'ARRAY_A');

        foreach ($results as $result) {
            $entries[] = new Entry($result);
        }

        return $entries;
    }

    public function save(Entry $entry)
    {
        $query = "";
    }
}
