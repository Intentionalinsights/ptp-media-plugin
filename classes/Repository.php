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

    /**
     * @param $id
     * @return Entry|null
     */
    public function find($id)
    {
        $query = "SELECT * FROM {$this->mediaTable} WHERE id = %d";

        $wpQuery = $this->wpdb->prepare($query, $id);

        $result = $this->wpdb->get_results($wpQuery, 'ARRAY_A');

        if (!$result) {
            return null;
        }

        return new Entry($result[0]);
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
        $success = false;

        $data = [
            'title'       => $entry->title,
            'url'         => $entry->url,
            'date'        => $entry->date,
            'description' => $entry->description,
            'active'      => ($entry->active) ? '1' : '0',
        ];

        $formats = ['%s', '%s', '%s', '%s', '%d'];

        if ($entry->id) {

            if (false !== $this->wpdb->update($this->mediaTable, $data, ['id' => $entry->id], $formats, ['%d'])) {

                $success = true;
            }

        } else {

            if ($this->wpdb->insert($this->mediaTable, $data, $formats)) {
                $entry->id = $this->wpdb->insert_id;

                $success = true;
            }
        }

        return $success;
    }
}
