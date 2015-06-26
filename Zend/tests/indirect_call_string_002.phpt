--TEST--
Indirect call with empty class and/or method name.
--FILE--
<?php
class TestClass
{
    public static function __callStatic($method, array $args)
    {
        var_dump($method);
    }
}

// Test call using array syntax
$callback = ['TestClass', ''];
$callback();

// Test call using Class::method syntax.
$callback = 'TestClass::';
$callback();

// Test array syntax with empty class name
$callback = '::method';
try {
    $callback();
} catch (Error $e) {
    echo $e->getMessage() . "\n";
}

// Test Class::method syntax with empty class name
$callback = '::method';
try {
    $callback();
} catch (Error $e) {
    echo $e->getMessage() . "\n";
}

// Test array syntax with empty class and method name
$callback = ['', ''];
try {
    $callback();
} catch (Error $e) {
    echo $e->getMessage() . "\n";
}

// Test Class::method syntax with empty class and method name
$callback = '::';
try {
    $callback();
} catch (Error $e) {
    echo $e->getMessage() . "\n";
}
?>
--EXPECT--
string(0) ""
string(0) ""
Class '' not found
Class '' not found
Class '' not found
Class '' not found
