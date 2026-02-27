<?php


namespace Domain\Producten\DataTransferObjects;

// Gegevens voor een product
class ProductenUpsertData
{
    /**
     * @param array<int, array{variant_id?: int|string|null, extra_prijs?: string|int|float|null}>|null $varianten
     * @param array<int, int|string>|null $categorie
     * @param array<int, int|string>|null $allergieen
     */
    // Maak een nieuw product aan
    public function __construct(
        public string $naam,
        public string $beschrijving,
        public string $prijs,
        public ?array $varianten = null,
        public ?array $categorie = null,
        public ?array $allergieen = null,
        public ?int   $restaurant_id = null,
    )
    {
    }

    /**
     * @return array{
     *     naam: string,
     *     beschrijving: string,
     *     prijs: string,
     *     varianten: array<int, array{variant_id?: int|string|null, extra_prijs?: string|int|float|null}>|null,
     *     categorie: array<int, int|string>|null,
     *     allergieen: array<int, int|string>|null,
     *     restaurant_id: ?int
     * }
     */
    // Zet dit object om naar een lijst
    public function toArray(): array
    {
        return [
            'naam' => $this->naam,
            'beschrijving' => $this->beschrijving,
            'prijs' => $this->prijs,
            'varianten' => $this->varianten,
            'categorie' => $this->categorie,
            'allergieen' => $this->allergieen,
            'restaurant_id' => $this->restaurant_id,
        ];
    }
}
