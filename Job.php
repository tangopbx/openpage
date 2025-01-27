<?php

namespace FreePBX\modules\Openpage;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class Job implements \FreePBX\Job\TaskInterface
{
	public static function run(InputInterface $input, OutputInterface $output){
		$op = \FreePBX::Openpage();
		return $op->generateEvents();
	}
}