<?php

$wsdl_file = isset($argv[1]) ? $argv[1] : '';
$directory = isset($argv[2]) ? $argv[2] : '';
$namespace = isset($argv[3]) ? $argv[3] : '';

if (!is_dir($directory)) {
    echo "DIRECTORY " . $directory . " DOESN'T EXISTS";
    exit;
}

if ($namespace == '') {
    echo "NAMESPACE MUST BE PROVIDED";
    exit;
}

if (file_exists($wsdl_file)) {

    require __DIR__ . '/vendor/autoload.php';

    $generator = new \Wsdl2PhpGenerator\Generator();
    $generator->generate(
        new \Wsdl2PhpGenerator\Config(array(
            'inputFile' => $wsdl_file,
            'outputDir' => $directory,
            'namespaceName' => $namespace,
        ))
    );

    echo "DONE";

} else {
    echo "FILE " . $wsdl_file . " NOT FOUND";
}
