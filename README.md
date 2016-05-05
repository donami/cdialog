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

$di->set('HTMLTable', 'donami\CTable\CTable');

$data = array(
  array('First', 'Second', 'Third'),
  array('Fourth', 'Fifth', 'Sixth')
);

echo $app->HTMLTable->generate($data);
```

Will output: 
```html
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
```
### One by one
This is useful when looping through data

```php
$di->set('HTMLTable', 'donami\CTable\CTable');

$app->HTMLTable->create_row(array('First', 'Second', 'Third'));
$app->HTMLTable->create_row(array('Fourth', 'Fifth', 'Sixth'));
echo $app->HTMLTable->generate();
```

### Defining tags:
Used for customizing the style of the table.

Example: Set the background of the table to purple

```php
$app->HTMLTable->defineTags(array('table_start' => '<table style="background: purple">'));
```


Links:
Packagist: https://packagist.org/packages/donami/ctable
