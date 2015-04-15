<?php

namespace VinaiKopp\PostCodeFilter\UseCases;

use VinaiKopp\PostCodeFilter\Query\RuleSpecByCountryAndGroupId;
use VinaiKopp\PostCodeFilter\Query\RuleReader;
use VinaiKopp\PostCodeFilter\RuleComponents\Country;
use VinaiKopp\PostCodeFilter\RuleComponents\CustomerGroupId;

class CustomerChecksPostCode
{
    /**
     * @var RuleReader
     */
    private $ruleReader;

    public function __construct(RuleReader $ruleReader)
    {
        $this->ruleReader = $ruleReader;
    }
    
    /**
     * @param int $customerGroupId
     * @param string $iso2country
     * @param string $postCode
     * @return bool
     */
    public function mayOrder($customerGroupId, $iso2country, $postCode)
    {
        $spec = new RuleSpecByCountryAndGroupId(
            CustomerGroupId::fromInt($customerGroupId),
            Country::fromIso2Code($iso2country)
        );
        $rule = $this->ruleReader->findByCountryAndGroupId($spec);
        return $rule->isPostCodeAllowed($postCode);
    }
}
