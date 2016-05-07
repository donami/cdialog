<?php
namespace donami\CTable;
/**
 * A testclass
 *
 */
class CTableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test with no data input
     *
     * @return void
     *
     */
    public function testWithEmptyData()
    {
      $table = new \donami\CTable\CTable();

      $html = $table->generate();
      $exp = '<table></table>';
      $this->assertEquals($html, $exp, 'Test with empty data fail');
    }

    /**
     * Test with one array
     *
     * @return void
     */
    public function testWithOneArray()
    {
      $table = new \donami\CTable\CTable();

      $data = array(
        ['One', 'Two', 'Three']
      );

      $html = $table->generate($data);
      $exp = '<table><tr><td>One</td><td>Two</td><td>Three</td></tr></table>';
      $this->assertEquals($html, $exp, 'Test with one aray fail');
    }

    /**
     * Test with multiple arrays
     *
     * @return void
     */
    public function testWithMultipleArrays()
    {
      $table = new \donami\CTable\CTable();

      $data = array(
        ['One', 'Two', 'Three'],
        ['Four', 'Five', 'Six'],
      );

      $html = $table->generate($data);
      $exp = '<table><tr><td>One</td><td>Two</td><td>Three</td></tr><tr><td>Four</td><td>Five</td><td>Six</td></tr></table>';
      $this->assertEquals($html, $exp, 'Test with one aray fail');
    }

    /**
     * Test setting table tag
     *
     * @return void
     */
    public function testSettingTableTag()
    {
      $table = new \donami\CTable\CTable();

      $table->defineTags(['table_start' => '<table style="border: 1px solid purple">']);

      $data = array(
        ['One', 'Two', 'Three']
      );

      $html = $table->generate($data);
      $exp = '<table style="border: 1px solid purple"><tr><td>One</td><td>Two</td><td>Three</td></tr></table>';
      $this->assertEquals($html, $exp, 'Test setting table tag failed');
    }

    /**
     * Test setting headings
     *
     * @return void
     */
    public function testSettingHeadings()
    {
      $table = new \donami\CTable\CTable();

      $table->defineHeadings(['First column', 'Second Column', 'Third Column']);

      $data = array(
        ['One', 'Two', 'Three']
      );

      $html = $table->generate($data);
      $exp = '<table><tr><th>First column</th><th>Second Column</th><th>Third Column</th></tr><tr><td>One</td><td>Two</td><td>Three</td></tr></table>';
      $this->assertEquals($html, $exp, 'Test setting table tag failed');
    }


    /**
     * Test create row function
     *
     * @return void
     */
    public function testCreateRowFunc()
    {
      $table = new \donami\CTable\CTable();

      $table->createRow(['First', 'Second', 'Third']);
      $table->createRow(['Fourth', 'Fifth', 'Sixth']);

      $html = $table->generate();
      $exp = '<table><tr><td>First</td><td>Second</td><td>Third</td></tr><tr><td>Fourth</td><td>Fifth</td><td>Sixth</td></tr></table>';
      $this->assertEquals($html, $exp, 'Test create row function failed');
    }


}
