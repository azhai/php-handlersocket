# php-handlersocket
PHP调用MySQL插件HandlerSocket，基于 [kjdev/php-ext-handlersocketi](https://github.com/kjdev/php-ext-handlersocketi)

PHP 7.x 请使用 https://codeload.github.com/tony2001/php-ext-handlersocketi/zip/badoo-7.0

## Connect DB, use table and fields
```php
$hs = new HandlerSocket('db_test', '127.0.0.1', 9999);
$fields = ['id','username','score','modified_at','is_active'];
$hs->open('t_users', $fields);
```
## Write records
**Insert**:
```php
$now = date('Y-m-d H:i:s');
$row = [1,'ryan',60,$now,true];
$hs->insert(array_combine($fields, $row));
```
**Update**:
```php
#new data, pkey or index, id or index value
$hs->update([1, 'David', 80, $now, true], null, 1); 
```
**Delete**:
```php
$hs->delete(1); #the id
```

## Read
**Get one row by id**:
```php
$ryan = $hs->get(1);
```
**Get one row by index**:
```php
$ryan = $hs->get('username', 'ryan');
```
**Find some rows by pkey or index**:
```php
#pkey or index, operation, value, limit, offset
#operation: > >= < <=
$ryan = $hs->all(null, '>=', 1, 3, 1);
```
**Find some rows, pkey or index in value list**:
```php
$ryan = $hs->in('username', 'ryan', 'jane');
#or
$ryan = $hs->in('username', ['ryan', 'jane']);
```
