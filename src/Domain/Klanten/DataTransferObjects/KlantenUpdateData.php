<?php

namespace Domain\Klanten\DataTransferObjects;

class KlantenUpdateData
{
    public function __construct(
        public string $voornaam,
        public string $achternaam,
        public string $adres,
        public string $email,
        public string $telefoonnummer,
    )
    {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromRequest(array $data): self
    {
        return new self(
            voornaam: $data['voornaam'],
            achternaam: $data['achternaam'],
            adres: $data['adres'],
            email: $data['email'],
            telefoonnummer: $data['telefoonnummer'],
        );
    }

    /**
     * @return array<string, string|null>
     */
    public function toArray(): array
    {
        return [
            'voornaam' => $this->voornaam,
            'achternaam' => $this->achternaam,
            'adres' => $this->adres,
            'email' => $this->email,
            'telefoonnummer' => $this->telefoonnummer,
        ];
    }
}
