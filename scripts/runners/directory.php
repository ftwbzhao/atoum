<?php

namespace mageekguy\atoum\runners;

use \mageekguy\atoum;

require_once(__DIR__ . '/../../classes/runner.php');

if (PHP_SAPI === 'cli' && realpath($_SERVER['argv'][0]) === __FILE__)
{
	foreach (array_slice($_SERVER['argv'], 1) as $path)
	{
		if (is_dir($path) === true)
		{
			foreach (new \recursiveIteratorIterator(new directory\filter(new \recursiveDirectoryIterator($path))) as $file)
			{
				require($file->getPathname());
			}
		}
	}
}

?>