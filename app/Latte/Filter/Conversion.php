<?php

declare(strict_types=1);

namespace App\Latte\Filter;

use Nette;
use Latte;

class Conversion
{
    private Nette\Caching\Cache $cache;

    public function __construct(Nette\Caching\Storage $storage)
    {
        $this->cache = new Nette\Caching\Cache($storage, 'nette-shop');
    }

    #[Latte\Attributes\TemplateFilter]
    public function convert(int|float $amount, string $currency = 'EUR'): float
    {
        return $amount / $this->getConversionRate($currency);
    }

    private function getConversionRate(string $currency): float
    {
        return $this->cache->load(
            'conversion-rate-' . $currency,
            function (&$dependencies) {
                $dependencies[Nette\Caching\Cache::Expire] = '1 hour';

                $url = "https://www.cnb.cz/cs/financni_trhy/devizovy_trh/kurzy_devizoveho_trhu/denni_kurz.txt";
                $content = file_get_contents($url);
                $lines = explode("\n", $content);

                foreach ($lines as $line) {
                    $fields = explode('|', $line);
                    $currency = $fields[3] ?? null;
                    if ($currency === 'EUR') {
                        $rate = (float) str_replace(",", ".", $fields[4]);
                        $amount = (float) str_replace(",", ".", $fields[2]);

                        return $rate / $amount;
                    }
                }

                return null;
            }
        );
    }

}