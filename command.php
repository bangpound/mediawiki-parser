#!/usr/bin/env php
<?php

require 'vendor/autoload.php';
putenv('MW_INSTALL_PATH=' . __DIR__ . '/vendor/mediawiki/core' );
$_SERVER['REMOTE_ADDR']='127.0.0.1';
require('vendor/mediawiki/core/includes/WebStart.php');

use Rshief\Wikimedia\Application;

$application = new Application('Rshief WikiMedia Parser');
$application->run();
