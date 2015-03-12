<?php


namespace VinaiKopp\PostCodeFilter\Command;


use VinaiKopp\PostCodeFilter\RuleComponents\Country;
use VinaiKopp\PostCodeFilter\RuleComponents\CustomerGroupIdList;
use VinaiKopp\PostCodeFilter\RuleComponents\PostCodeList;

class RuleToUpdate
{
    /**
     * @var Country
     */
    private $oldCountry;
    
    /**
     * @var CustomerGroupIdList
     */
    private $oldCustomerGroupIds;
    
    /**
     * @var Country
     */
    private $newCountry;
    
    /**
     * @var CustomerGroupIdList
     */
    private $newCustomerGroupIds;
    
    /**
     * @var PostCodeList
     */
    private $newPostCodes;

    public function __construct(
        Country $oldCountry,
        CustomerGroupIdList $oldCustomerGroupIds,
        Country $newCountry,
        CustomerGroupIdList $newCustomerGroupIds,
        PostCodeList $newPostCodes
    ) {

        $this->oldCountry = $oldCountry;
        $this->oldCustomerGroupIds = $oldCustomerGroupIds;
        $this->newCountry = $newCountry;
        $this->newCustomerGroupIds = $newCustomerGroupIds;
        $this->newPostCodes = $newPostCodes;
    }
    
    public function getOldCountryValue()
    {
        return $this->oldCountry->getValue();
    }

    public function getOldCountry()
    {
        return $this->oldCountry;
    }

    public function getOldCustomerGroupIds()
    {
        return $this->oldCustomerGroupIds;
    }

    public function getOldCustomerGroupIdValues()
    {
        return $this->oldCustomerGroupIds->getValues();
    }

    public function getNewCountry()
    {
        return $this->newCountry;
    }

    public function getNewCountryValue()
    {
        return $this->newCountry->getValue();
    }

    public function getNewCustomerGroupIds()
    {
        return $this->newCustomerGroupIds;
    }

    public function getNewCustomerGroupIdValues()
    {
        return $this->newCustomerGroupIds->getValues();
    }

    public function getNewPostCodes()
    {
        return $this->newPostCodes;
    }

    public function getNewPostCodeValues()
    {
        return $this->newPostCodes->getValues();
    }
}