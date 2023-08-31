<?php

namespace Src\Application\UseCase;

use Src\Application\Presenter\Presenter;
use Src\Application\Repository\ContractRepository;
use Src\Infra\Mediator\Mediator;
use Src\Infra\Presenter\JsonPresenter;

class GenerateInvoices implements UseCase
{

    public function __construct(
        readonly ContractRepository $contractRepository,
        readonly Presenter $presenter = new JsonPresenter(),
        readonly Mediator $mediator = new Mediator()
    ) {
    }


    public function execute(Input $input)
    {
        /** @var Output[] $outputArray */
        $outputArray = [];

        $contracts = $this->contractRepository->list();

        foreach ($contracts as $contract) {
            $invoices = $contract->generateInvoices($input->month, $input->year, $input->type);

            foreach ($invoices as $invoice) {
                $outputArray[] = new Output($invoice->date, $invoice->amount);
            }
        }

        $this->mediator->publish("InvoicesGenerated", $outputArray);

        return $this->presenter->present($outputArray);
    }
}

class Input {
    public function __construct(
        public int $month,
        public int $year,
        public string $type,
        public string $format = "json"
    ) {
    }
}

class Output {
    public function __construct(
        public string $date,
        public float $amount
    ) {
    }
}