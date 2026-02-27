<?php


namespace Domain\Producten\DataTransferObjects;

class AllergieenUpsertData
{
    public function __construct(
        public string $naam,
    )
    {}

    /**
     * @return array{naam: string}
     */
    public function toArray(): array
    {
        return [
            'naam' => $this->naam,
        ];
    }
}
