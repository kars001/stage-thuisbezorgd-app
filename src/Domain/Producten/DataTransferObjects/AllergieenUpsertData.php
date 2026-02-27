<?php


namespace Domain\Producten\DataTransferObjects;

// Gegevens voor een allergie
class AllergieenUpsertData
{
    // Maak een nieuwe allergie aan
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
