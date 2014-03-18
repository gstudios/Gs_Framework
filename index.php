<?php

/**
 * Description of Index
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */

require dirname(__FILE__).'/gs/constante.php';
require dirname(__FILE__).'/gs/autoloader.php';

new Autoload();

$app = new App();

$app->start()->run()->stop();