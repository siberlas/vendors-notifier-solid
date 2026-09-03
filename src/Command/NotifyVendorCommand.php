<?php

declare(strict_types=1);

namespace App\Command;

use App\DTO\CreateOrderDTO;
use App\Service\OrderService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:order:notify-vendor',
    description: 'Notifier le vendors de la commande test',
)]
class NotifyVendorCommand extends Command
{
    public function __construct(
        private readonly OrderService $orderService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('dry-run', null, InputOption::VALUE_NONE, 'simulation sans modification')
            ->addArgument('vendorId', InputArgument::REQUIRED, 'id du vendor à modifier')
            ->addArgument('productName', InputArgument::REQUIRED, 'Nom du produit')
            ->addArgument('price', InputArgument::REQUIRED, 'prix du produit');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output,
    ): int {
        $io = new SymfonyStyle($input, $output);
        $dryRun = $input->getOption('dry-run');
        $vendorId = (int)$input->getArgument('vendorId');
        $productName = (string)$input->getArgument('productName');
        $price = (float)$input->getArgument('price');

        $io->title('Création de la commande test et notification du vendor');

        if ($dryRun) {
            $io->warning(sprintf(
                '[DRY-RUN] Commande simulée - Vendor #%d, %s, %.2f€',
                $vendorId,
                $productName,
                $price,
            ));

            return Command::SUCCESS;
        }

        $orderDto = new CreateOrderDTO(
            vendorId: $vendorId,
            productName: $productName,
            price: $price,
        );

        $order = $this->orderService->createOrder($orderDto);

        $io->success(sprintf(
            'la commande %s (%.2f€) a bien été créé et le fournisseur notifé',
            $order->getProductName(),
            $order->getPrice(),
        ));

        return Command::SUCCESS;
    }
}
