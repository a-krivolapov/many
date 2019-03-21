<?php
/**
 * Created by PhpStorm.
 * User: ak
 * Date: 20.03.19
 * Time: 23:08
 */

namespace App\Command;


use App\Exception\InputException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BillsCommand extends Command
{
    protected function configure()
    {
        $this->setName('bills')
            ->setDescription('Prints all of bills')
            ->setHelp('Returns amount divided into bills')
            ->addArgument('amount', InputArgument::REQUIRED, 'Input amount');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $amount = $input->getArgument('amount');
        if (!is_numeric($amount)) {
            throw new InputException('Введено не числовое значение');
        }

        $bills = getenv('BILLS');
        $bills = explode(',', $bills);
        arsort($bills);

        foreach ($bills as $bill) {
            $answer[$bill] = ($amount - ($amount % $bill))/$bill;
            $amount %= $bill;
        }

        if ($amount != 0) {
            throw new InputException('Введена неверная сумма');
        }

        foreach ($answer as $bill => $count) {
            $output->writeln(sprintf("Номиналом %s необхоимо купюр %s", $bill, $count));
        }

    }
}