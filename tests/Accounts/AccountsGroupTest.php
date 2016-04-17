<?php

namespace Billy\Tests\Accounts;

use Billy\Client\Request;
use Billy\Accounts\AccountGroupsRepository;

class AccountsGroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request.
     */
    protected $request;

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

    /**
     * @var Account[]
     */
    protected $accountGroups;

    /**
     * @var AccountGroupsRepository
     */
    protected $accountsGroupRepository;

    public function __construct()
    {
        $this->request = new Request($this->api_key);
    }

    public function testAccountGroupRepositoryConstruct()
    {
        // Ensure that the AccountGroupsRepository can be initiated.
        $repository = new AccountGroupsRepository($this->request);

        $this->assertNotNull($repository, 'Able to initiate account group repository');

        return $this->accountsGroupRepository = $repository;
    }

    public function testAccountGroupRepositoryGetAll()
    {

        $repository = $this->testAccountGroupRepositoryConstruct();
        $results = $repository->getAll();
        $this->assertNotEmpty($results, 'Group repository returned results');

        return $this->accountGroups = $results;
    }

    public function testAccountGroupRepositoryGetSingle()
    {
        /** @var Account $firstContact */
        $accountGroups = $this->testAccountGroupRepositoryGetAll();
        $firstAccountGroup = reset($accountGroups);

        $accountGroupRepository = $this->testAccountGroupRepositoryConstruct();
        $accountGroup = $accountGroupRepository->getSingle($firstAccountGroup->getID());
        $this->assertNotEmpty($accountGroup);
        $this->assertNotEmpty($accountGroup->getOrganization());
    }
}
