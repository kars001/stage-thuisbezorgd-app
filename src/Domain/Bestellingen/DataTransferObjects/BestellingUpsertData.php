<?php

namespace Domain\Bestellingen\DataTransferObjects;

use Domain\Bestellingen\Enums\BestellingStatusEnum;

// Gegevens voor een bestelling
class BestellingUpsertData
{
    // Maak een nieuwe bestelling aan
    public function __construct(
        public int $klanten_id,
        public int $restaurant_id,
        public BestellingStatusEnum $status,
        public ?float $verzendkosten = null,
        public ?float $totaalprijs = null,
    )
    {}

    /**
     * @param array<string, mixed> $data
     */
    // Maak dit object vanuit een request
    public static function fromRequest(array $data): self
    {
        return new self(
            klanten_id: (int) $data['klanten_id'],
            restaurant_id: (int) $data['restaurant_id'],
            status: array_key_exists('status', $data) ? BestellingStatusEnum::from($data['status']) : BestellingStatusEnum::Gemaakt,
            verzendkosten: array_key_exists('verzendkosten', $data) ? (float) $data['verzendkosten'] : null,
            totaalprijs: array_key_exists('totaalprijs', $data) ? (float) $data['totaalprijs'] : null,
        );
    }

    /**
     * @return array{status: BestellingStatusEnum|null, klanten_id: int, restaurant_id: int, verzendkosten: float|null, totaalprijs: float|null}
     */
    // Zet dit object om naar een lijst
    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'klanten_id' => $this->klanten_id,
            'restaurant_id' => $this->restaurant_id,
            'verzendkosten' => $this->verzendkosten,
            'totaalprijs' => $this->totaalprijs,
        ];
    }
}
