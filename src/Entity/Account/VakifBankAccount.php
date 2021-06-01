<?php

namespace Mews\Pos\Entity\Account;

class VakifBankAccount extends AbstractPosAccount
{
    private static $merchantTypes = [0, 1, 2];

    /**
     * @var string
     */
    private $terminalId;

    /**
     * Banka tarafından Üye işyerine iletilmektedir
     * Standart İş yeri: 0
     * Ana Bayi: 1
     * Alt Bayi:2
     * @var int
     */
    private $merchantType;

    /**
     * Ör:00000000000471
     * Alfanumeric. Banka tarafından AltBayiler için üye işyerine iletilecektir.
     * Üye işyeri için bu değer sabittir.
     * MerchantType: 2 ise zorunlu,
     * MerchantType: 0 ise, gönderilmemeli
     * MerchantType: 1 ise, Ana bayi kendi adına işlem geçiyor ise gönderilmemeli,
     * Altbayisi adına işlem geçiyor ise zorunludur.
     * @var string|null
     */
    private $subMerchantId;

    /**
     * VakifBankAccount constructor.
     *
     * @param string   $bank
     * @param string   $model
     * @param string   $merchantId Isyeri No
     * @param string   $password   Isyeri Sifre
     * @param string   $terminalId Terminal No
     * @param int      $merchantType
     * @param string|null $subMerchantId
     */
    public function __construct(
        string $bank,
        string $model,
        string $merchantId,
        string $password,
        string $terminalId,
        int $merchantType = 0,
        string $subMerchantId = null
    ) {
        parent::__construct($bank, $model, $merchantId, '', $password, 'tr');
        $this->model = $model;
        $this->terminalId = $terminalId;
        $this->merchantType = $merchantType;
        $this->subMerchantId = $subMerchantId;
    }

    /**
     * @return string
     */
    public function getTerminalId(): string
    {
        return $this->terminalId;
    }

    /**
     * @return int
     */
    public function getMerchantType(): int
    {
        return $this->merchantType;
    }

    /**
     * @return string|null
     */
    public function getSubMerchantId(): ?string
    {
        return $this->subMerchantId;
    }

    /**
     * @return bool
     */
    public function isSubBranch(): bool
    {
        return 2 === $this->merchantType;
    }

    /**
     * @return int[]
     */
    public static function getMerchantTypes(): array
    {
        return self::$merchantTypes;
    }
}
