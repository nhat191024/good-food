<?php

namespace App\Console\Commands;

use App\Models\Bill;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('bills:seed {count=20 : Số lượng hóa đơn cần tạo}')]
#[Description('Tạo dữ liệu hóa đơn mẫu cho môi trường phát triển')]
class SeedBillsCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $count = (int) $this->argument('count');

        $this->info("Đang tạo {$count} hóa đơn mẫu...");

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        Bill::factory()
            ->count($count)
            ->create()
            ->each(function () use ($bar): void {
                $bar->advance();
            });

        $bar->finish();
        $this->newLine();
        $this->info("Đã tạo thành công {$count} hóa đơn mẫu.");

        return self::SUCCESS;
    }
}

