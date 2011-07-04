<?php

namespace mageekguy\atoum\reports\asynchronous;

use
	\mageekguy\atoum,
	\mageekguy\atoum\cli\prompt,
	\mageekguy\atoum\cli\colorizer,
	\mageekguy\atoum\exceptions,
	\mageekguy\atoum\report\fields\test,
	\mageekguy\atoum\report\fields\runner
;

class builder extends atoum\reports\asynchronous
{
	public function __construct(atoum\locale $locale = null, atoum\adapter $adapter = null)
	{
		parent::__construct($locale, $adapter);

		$runnerVersionField = new runner\version\cli(new prompt(''));
		$runnerPhpField = new runner\php\cli(new prompt(''), null, new prompt('   '));
		$runnerDurationField = new runner\duration\cli(new prompt(''));
		$runnerResultField = new runner\result\cli();
		$runnerFailuresField = new runner\failures\cli(new prompt(''), new colorizer(), new prompt('   ', new colorizer()), new colorizer());
		$runnerOutputsField = new runner\outputs\cli(null, null, new prompt('   '));
		$runnerErrorsField = new runner\errors\cli(new prompt(''), new colorizer(), new prompt('   '), new colorizer(), new prompt('      '), new colorizer());
		$runnerExceptionsField = new runner\exceptions\cli(new prompt(''), new colorizer(), new prompt('   '), new colorizer(), new prompt('      '), new colorizer());
		$runnerTestsDurationField = new runner\tests\duration\cli(null, '');
		$runnerTestsMemoryField = new runner\tests\memory\cli(new prompt(''));
		$runnerTestsCoverageField = new runner\tests\coverage\cli(null, '', '   ', '      ');

		$testRunField = new test\run\cli(null, '');
		$testDurationField = new test\duration\cli(null, '   ');
		$testMemoryField = new test\memory\cli(null, '   ');

		$this
			->addRunnerField($runnerVersionField, array(atoum\runner::runStart))
			->addRunnerField($runnerPhpField, array(atoum\runner::runStart))
			->addRunnerField($runnerTestsDurationField, array(atoum\runner::runStop))
			->addRunnerField($runnerTestsMemoryField, array(atoum\runner::runStop))
			->addRunnerField($runnerTestsCoverageField, array(atoum\runner::runStop))
			->addRunnerField($runnerDurationField, array(atoum\runner::runStop))
			->addRunnerField($runnerResultField, array(atoum\runner::runStop))
			->addRunnerField($runnerFailuresField, array(atoum\runner::runStop))
			->addRunnerField($runnerOutputsField, array(atoum\runner::runStop))
			->addRunnerField($runnerErrorsField, array(atoum\runner::runStop))
			->addRunnerField($runnerExceptionsField, array(atoum\runner::runStop))
			->addTestField($testRunField, array(atoum\test::runStart))
			->addTestField($testDurationField, array(atoum\test::runStop))
			->addTestField($testMemoryField, array(atoum\test::runStop))
		;
	}
}

?>
