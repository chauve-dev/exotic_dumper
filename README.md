# exotic dumper
This package allow you to dump data in new ways.
It's based on symfony serializer and dumper.

## Functions
Currently there is only two functions
One to display the dump in a small window on the page

### pretty_dump
the parameters are : 
- array|object : data to print
- bool : should hide by default the dump (display it in line on the bottom of the page)
- string : name of the dump (it should display in the titlebar of the dump)
```php
<?php
pretty_dump($data, true, 'name of dump');
?>
```

### console_dump
the parameters are :
- array|object : data to print
- string : name the group log
- string : type of log you wanna use see [MDN doc for console](https://developer.mozilla.org/fr/docs/Web/API/Console)
```php
<?php
console_dump($var, 'log for item x', 'log');
?>
```
## Demo
![Animation](https://user-images.githubusercontent.com/33525107/192359755-7d3db650-1df6-4743-a2cb-f9f308376226.gif)
