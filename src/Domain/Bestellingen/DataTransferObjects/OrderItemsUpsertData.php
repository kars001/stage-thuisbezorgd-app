<?php

namespace Domain\Bestellingen\DataTransferObjects;

// Gegevens voor een bestelregel
class OrderItemsUpsertData
{
    // Maak een nieuwe bestelregel aan
    public function __construct(
        public int $aantal,
        public int $bestellingen_id,
        public int $producten_id,
        public int $varianten_id,
        public ?float $prijs = null,
    )
    {}

    /**
     * @param array<string, mixed> $data
     */
    // Maak dit object vanuit een request
    public static function fromRequest(array $data): self
    {
        return new self(
            aantal: (int) $data['aantal'],
            bestellingen_id: (int) $data['bestellingen_id'],
            producten_id: (int) $data['producten_id'],
            varianten_id: (int) $data['varianten_id'],
            prijs: array_key_exists('prijs', $data) ? (float) $data['prijs'] : null,
        );
    }

    /**
     * @return array{prijs: float|null, aantal: int, bestellingen_id: int, producten_id: int, varianten_id: int}
     */
    // Zet dit object om naar een lijst
    public function toArray(): array
    {
        return [
            'prijs' => $this->prijs,
            'aantal' => $this->aantal,
            'bestellingen_id' => $this->bestellingen_id,
            'producten_id' => $this->producten_id,
            'varianten_id' => $this->varianten_id,
        ];
    }
}
