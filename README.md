# CTable - Table module for Anax

CTable is a module for Anax used for creating HTML Tables in an easy manner.

## How to:
Install CTable by using composer:
```
composer require donami/ctable
```

## Usage: 
### Create a HTML table from array

Use an array to create the table:
```php
$data = array(
  array('First', 'Second', 'Third'),
  array('Fourth', 'Fifth', 'Sixth')
)

echo generate($data);

/* Output:  
<table>
  <tr>
    <td>First</td>
    <td>Second</td>
    <td>Third</td>
  </tr>
  <tr>
    <td>Fourth</td>
    <td>Fifth</td>
    <td>Sixth</td>
  </tr>
</table>
*/
```
### One by one
This is useful when looping through data

```php
create_row(array('First', 'Second', 'Third'));
create_row(array('Fourth', 'Fifth', 'Sixth'));
```

### Defining tags:
Used for customizing the style of the table.

Example: Set the background of the table to purple

```php
defineTags(array('table_start' => '<table style="background: purple">'));
```


Links:
Packagist: https://packagist.org/packages/donami/ctable
