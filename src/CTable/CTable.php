<?php

namespace donami\CTable;

/**
 * Create a HTML table from array
 *
 * Usage:
 *
 * -- Using one array for the data --
 * $data = array(
 * 	array('First', 'Second', 'Third'),
 * 	array('Fourth', 'Fifth', 'Sixth')
 * )
 *
 * generate($data) => Will generate a HTML Table which consists of two rows with three columns
 *
 *
 * -- One by one --
 * This is good for when looping through data
 *
 * create_row(array('First', 'Second', 'Third'));
 * create_row(array('Fourth', 'Fifth', 'Sixth'));
 *
 * -- Defining tags --
 *
 * Example: Set the background of the table to purple
 *
 * defineTags(array('table_start' => '<table style="background: purple">'));
 */
class CTable implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
    private $data = array();
    private $html = '';
    private $headings = '';

    private $tags = array(
      'table_start' => '<table>',
      'table_end' => '</table>',
      'tr_start' => '<tr>',
      'tr_end' => '</tr>',
      'td_start' => '<td>',
      'td_end' => '</td>',
      'th_start' => '<th>',
      'th_end' => '</th>'
    );

    /**
     * Set up custom tags for designing the table
     * @param  array  $data Array containing the tags to define
     * @return void
     */
    public function defineTags($data = array()) {
      foreach ($data as $key => $value) {
        $this->tags[$key] = $value;
      }
    }

    /**
     * Define the headings for the table
     * @param  array  $data Array containing the headings
     * @return void
     */
    public function defineHeadings($data = array()) {
      $html = $this->tags['tr_start'];
      foreach ($data as $value) {
        $html .= $this->tags['th_start'];
        $html .= $value;
        $html .= $this->tags['th_end'];
      }
      $html .= $this->tags['tr_end'];
      $this->headings = $html;
    }

    /**
     * Adds a row to the table one by one
     * @param  array  $data Array containing one key for each field
     * @return void
     */
    public function createRow($data = array()) {
      $this->data[] = $data;
    }

    /**
     * Generate the HTML for the table. Either using $this->data or data as argument
     * @param  array  $data Optional array to be used
     *         if no data has been set before through "create_row"
     * @return string The HTML to be returned
     */
    public function generate($data = array()) {
      $data = !empty($data)? $data : $this->data;

      $html = $this->tags['table_start'];

      $html .= $this->headings;

      foreach ($data as $key => $value) {
        $html .= $this->tags['tr_start'];;
        foreach ($value as $td) {
          $html .= $this->tags['td_start'];
          $html .= $td;
          $html .= $this->tags['td_end'];
        }
        $html .= $this->tags['tr_end'];
      }

      $html .= $this->tags['table_end'];

      return $html;
    }
}
