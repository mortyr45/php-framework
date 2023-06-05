<?php # USE: php -d phar.readonly=off create-phar.php
$phar = new Phar(__DIR__.DIRECTORY_SEPARATOR.'build'.DIRECTORY_SEPARATOR.'pmp-framework.phar');
$phar->buildFromDirectory(__DIR__.DIRECTORY_SEPARATOR.'src/private/library/');
$phar->setDefaultStub('load.php');

echo "Build Success\n";