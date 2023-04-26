<?php



namespace App\Utils;

class EtatFilter
{
    private $etatlivs;

    public function __construct(array $etatlivs)
    {
        $this->etatlivs = $etatlivs;
    }

    public function hasBadword(string $message): bool
    {
        foreach ($this->etatlivs as $etatliv) {
            if (strpos($message, $etatliv) !== false) {
                return true;
            }
        }

        return false;
    }
}