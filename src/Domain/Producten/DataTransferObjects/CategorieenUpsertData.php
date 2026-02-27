<?php


namespace Domain\Producten\DataTransferObjects;

// Gegevens voor een categorie
class CategorieenUpsertData
{
    // Maak een nieuwe categorie aan
    public function __construct(
        public string $naam,
    )
    {}

    /**
     * @return array{naam: string}
     */
    // Zet dit object om naar een lijst
    public function toArray(): array
    {
        return [
            'naam' => $this->naam,
        ];
    }
}
