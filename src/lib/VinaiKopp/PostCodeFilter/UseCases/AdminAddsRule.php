<?php


namespace VinaiKopp\PostCodeFilter\UseCases;


use VinaiKopp\PostCodeFilter\Command\RuleToAdd;
use VinaiKopp\PostCodeFilter\Command\RuleWriter;
use VinaiKopp\PostCodeFilter\Exceptions\RuleAlreadyExistsException;
use VinaiKopp\PostCodeFilter\Query\QueryByCountryAndGroupIds;
use VinaiKopp\PostCodeFilter\Query\RuleFound;
use VinaiKopp\PostCodeFilter\Query\RuleReader;

class AdminAddsRule
{
    /**
     * @var RuleWriter
     */
    private $ruleWriter;
    
    /**
     * @var RuleReader
     */
    private $ruleReader;

    public function __construct(RuleWriter $ruleWriter, RuleReader $ruleReader)
    {
        $this->ruleWriter = $ruleWriter;
        $this->ruleReader = $ruleReader;
    }

    /**
     * @param RuleToAdd $ruleToAdd
     * @throws \Exception
     */
    public function addRule(RuleToAdd $ruleToAdd)
    {
        try {
            $this->ruleWriter->beginTransaction();
            $this->validateNoConflictingRuleExists($ruleToAdd);
            $this->ruleWriter->createRule($ruleToAdd);
            $this->ruleWriter->commitTransaction();
        } catch (\Exception $e) {
            $this->ruleWriter->rollbackTransaction();
            throw $e;
        }
    }

    /**
     * @param RuleToAdd $ruleToAdd
     */
    private function validateNoConflictingRuleExists(RuleToAdd $ruleToAdd)
    {
        $ruleQuery = $this->makeRuleQuery($ruleToAdd);
        $result = $this->ruleReader->findByCountryAndGroupIds($ruleQuery);
        if ($result instanceof RuleFound) {
            throw $this->makeRuleExistsException($result, $ruleToAdd);
        }
    }

    /**
     * @param RuleToAdd $ruleToAdd
     * @return QueryByCountryAndGroupIds
     */
    private function makeRuleQuery(RuleToAdd $ruleToAdd)
    {
        return new QueryByCountryAndGroupIds($ruleToAdd->getCountry(), $ruleToAdd->getCustomerGroupIds());
    }

    /**
     * @param RuleFound $existingRule
     * @param RuleToAdd $ruleToAdd
     * @return RuleAlreadyExistsException
     */
    private function makeRuleExistsException(RuleFound $existingRule, RuleToAdd $ruleToAdd)
    {
        return new RuleAlreadyExistsException(sprintf(
            'A rule for customer group(s) "%s" and country "%s" already exists',
            implode(', ', $existingRule->getCustomerGroupIdValues()),
            $ruleToAdd->getCountryValue()
        ));
    }
}