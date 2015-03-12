<?php


namespace VinaiKopp\PostCodeFilter\Command;


use VinaiKopp\PostCodeFilter\RuleComponents\Country;
use VinaiKopp\PostCodeFilter\RuleComponents\CustomerGroupIdList;
use VinaiKopp\PostCodeFilter\RuleComponents\PostCodeList;

class RuleToAdd
{
    /**
     * @var CustomerGroupIdList
     */
    private $customerGroupIds;

    /**
     * @var string
     */
    private $country;

    /**
     * @var PostCodeList
     */
    private $postCodes;

    /**
     * @param CustomerGroupIdList $customerGroupIds
     * @param Country $country
     * @param PostCodeList $postCodes
     */
    public function __construct(CustomerGroupIdList $customerGroupIds, Country $country, PostCodeList $postCodes)
    {
        $this->customerGroupIds = $customerGroupIds;
        $this->country = $country;
        $this->postCodes = $postCodes;
    }

    /**
     * @return CustomerGroupIdList
     */
    public function getCustomerGroupIds()
    {
        return $this->customerGroupIds;
    }

    /**
     * @return int[]
     */
    public function getCustomerGroupIdValues()
    {
        return $this->customerGroupIds->getValues();
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCountryValue()
    {
        return $this->country->getValue();
    }

    /**
     * @return string[]
     */
    public function getPostCodeValues()
    {
        return $this->postCodes->getValues();
    }
}