# Основные концепции

Все встроенные функции `Python` представлены как статические методы класса `PyCore`, для использования встроенных методов смотрите `Python` документацию.

## Импорт пакетов
```php
$os = PyCore::import('os');
```

После успешного выполнения возвращается объект `PyModule`. Можно импортировать встроенные `Python` пакеты, а также другие сторонние пакеты или пользовательские пакеты.

Можно только загружать модули, не поддерживается синтаксис `from module import class` в `Python`, его можно заменить следующим образом.

```php
$module = PyCore::import($moduleName);
$class = $module->$className;
```

Внутренняя часть `Python` кэшаирует уже загруженные модули, и при повторном загрузке они автоматически возвращаются из кэша без повторной загрузки. Поэтому их также можно использовать в таких короткоживущих условиях, как `PHP-FPM/Apache`, и это не приведет к проблемам с производительность.

## Пути загрузки
Используйте `PyCore::import('sys')->path->append()` чтобы добавить некоторые каталоги в список путей загрузки.
Например, пользовательский пакет `/workspace/app/user.py` можно载入 следующим образом:

1. `PyCore::import('sys')->path->append('/workspace')` добавляет `/workspace` в `sys.path`
2. `PyCore::import('app.user')` автоматически ищет в `sys.path` соответствующий пакет `app/user.py` и загружает его

## Встроенные методы

- `PyCore::import($module)` импортирует модуль

- `PyCore::str()` превращает объект в строку

- `PyCore::repr()` 

- `PyCore::type()` получает тип объекта

- `PyCore::locals()` получает все локальные переменные текущего пространства

- `PyCore::globals()` получает все глобальные переменные

- `PyCore::hash()` получает значение Hash

- `PyCore::hasattr()` проверяет, существует ли у объекта определенное свойство

- `PyCore::id()` получает внутренний номер объекта

- `PyCore::len()` получает длину

- `PyCore::dir()` получает все свойства и методы объекта

- `PyCore::int()` создает целое число

- `PyCore::float()` создает числовое значение с плавающей точкой

- `PyCore::fn()` создает callable функцию

- `PyCore::eval()` выполняет `Python` код

- `PyCore::dict()` создает объект словаря

- `PyCore::set()` создает объект множества

- `PyCore::range()` создает последовательность диапазонов

- `PyCore::scalar($pyobj)` превращает `PyObject` в scalar тип PHP, например, `PyStr` превращается в `PHP строку`, `Dict/Tuple/Set/List` превращаются в `Array`
- `PyCore::fileno($fp)` получает файловый дескриптор ресурса PHP Stream, обратите внимание, что поддерживается только для ресурсов типа `tcp/udp/unix`

> `PyCore` реализует волшебный метод `__callStatic()`, и при вызове статического метода `PyCore` автоматически будет вызван соответствующий метод из модуля `builtins` Python,
> для получения большего количества информации о использовании встроенных методов смотрите [Встроенные функции](https://docs.python.org/3/library/functions.html)

## Проблемы с динамическими библиотеками
При импорте библиотеки возникают ошибки динамических библиотек, возможно, из-за неправильной настройки пути к динамическим библиотекам `LD`, можно установить переменную окружения для указания пути к динамическим библиотекам Python C.

> Можно использовать `:` для разделения и установки нескольких путей

```shell
# Использовать только базовое окружение anaconda3
export LD_LIBRARY_PATH=/opt/anaconda3/lib
# Используется особое окружение, имя cef
export LD_LIBRARY_PATH=/opt/anaconda3/envs/cef/lib:/opt/anaconda3/lib
php plot.php
```

Этот способ действителен только для текущей会话bash и не влияет на глобальное состояние. Не следует напрямую редактировать `/etc/ld.so.conf.d/*.conf`, добавляя `/opt/anaconda3/lib`, это может привести к конфликтам с библиотекой libc и может повлиять на нормальную работу других программ операционной системы.

## Sensitivity к captitalization
В `Python` все функции, методы, переменные, свойства и т.д. полностью чувствительны к captitalization, при вызове необходимо использовать имя, полностью соответствующее captitalization в `Python`.

Например:

```python
def TestUser():
    pass
```

В PHP-коде необходимо использовать `$module->TestUser()`, другие способы, такие как `$module->testUser()`, `$module->testuser()` являются неправильными写法ми.

## Переменные окружения
В `phpy` `os.environ` Python не инициализирован автоматически, поэтому `environ` является пустым словарем, необходимо遍历 `$_ENV`, чтобы вливать переменные окружения в Python-среду.

```php
$os = PyCore::import('os');
foreach($_ENV as $k => $v) {
    $os->environ->__setitem__($k, $v);
}
```

## undefined symbol:ffi_type_uint32, version LIBFFI_BASE_7.0
Существует проблема конфликта путей к динамическим библиотекам, можно попробовать использовать следующий метод для решения.
Если проблема все еще существует, рекомендуется использовать встроенную Python-среду системы вместо созданной с помощью conda среды.

```shell
export LD_PRELOAD=/usr/lib/x86_64-linux-gnu/libffi.so.7
```

## Import failure
В большинстве случаев `from a import b` эквивалентно `PyCore::import('a')->b`,
но некоторые особенные библиотеки не могут быть правильно загружены с помощью вышеуказанного метода, их можно заменить следующим образом:

```php
# Невозможно载入
$b = PyCore::import('a')->b;
# Заменить на следующий код
$b = PyCore::import('a.b');
```