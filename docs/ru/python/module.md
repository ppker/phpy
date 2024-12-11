# Обертка модуля
 `phpy` использует инструменты рефлексии для автоматического создания оберточных модулей для всех функций и классов PHP-расширений с пакетом имя `php`, которые можно использовать напрямую
 
```python
from php import [ext-name]
```

Для импорта констант, функций и классов, определенных в PHP-расширении.

## Правила именования

- Название модуля полностью用小写字符, например, `PDO`, соответствующий модуль `php.pdo`

- Стандартные функции библиотеки находятся в модуле `php.std`, например, `php.std.file_get_contents()`

- Функции ядра языка находятся в модуле `php.core`, например, `php.core.get_included_files()`

- Когда префикс функции совпадает с именем расширения, то префикс расширения опускается, например, `php.curl.curl_init()` следует упрощать до `php.curl.init()`

- Когда имя класса использует пространство имен и совпадает с именем расширения, оно превращается в camelCase классовое имя, например, `Swoole\Http\Server` становится `php.swoole.HttpServer`

- Когда имя функции использует пространство имен, оно превращается в snake_case функцию, например, `MongoDB\BSON\fromJSON` становится `php.mongodb.bson_fromjson`

- Когда имя функции или метода является ключевым словом Python, автоматически добавляется префикс подчеркивания, например, `gmp_import` становится `php.gmp._import`

## Объекты примеров

```python
from php import redis

db = redis.Redis()
db.connect("127.0.0.1", 6379, -1)
db.set("key", "swoole")
print(db.get("key"))
```

## Примеры функций

```python
from php import std
import phpy

errno = phpy.Reference()
errstr = phpy.Reference()
rs = std.stream_socket_client('tcp://127.0.0.1:9999', errno, errstr, 30)
```