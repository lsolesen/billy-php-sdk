<?php

namespace BillysBilling\Tests\Accounts;

use BillysBilling\Client\Billy_Request;
use BillysBilling\Accounts\Billy_Account;
use BillysBilling\Accounts\Billy_AccountGroupsRepository;
use BillysBilling\Accounts\Billy_AccountsRepository;

class AccountsGroupTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Billy_Request.
     */
    protected $request;

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

    /**
     * @var Billy_Account[]
     */
    protected $accountGroups;
    /**
     * @var Billy_AccountGroupsRepository
     */
    protected $accountsGroupRepository;

    public function __construct() {
        $this->request = new Billy_Request($this->api_key);
    }

    public function testAccountGroupRepositoryConstruct() {
        // Ensure that the AccountGroupsRepository can be initiated.
        $repository = new Billy_AccountGroupsRepository($this->request);

        $this->assertNotNull($repository, 'Able to initiate account group repository');

        return $this->accountsGroupRepository = $repository;
    }

    public function testAccountGroupRepositoryGetAll() {

        $repository = $this->testAccountGroupRepositoryConstruct();
        $results = $repository->getAll();
        $this->assertNotEmpty($results, 'Group repository returned results');

        return $this->accountGroups = $results;
    }

    public function testAccountGroupRepositoryGetSingle() {
        /** @var Billy_Account $firstContact */
        $accountGroups = $this->testAccountGroupRepositoryGetAll();
        $firstAccountGroup = reset($accountGroups);

        $accountGroupRepository = $this->testAccountGroupRepositoryConstruct();
        $accountGroup = $accountGroupRepository->getSingle($firstAccountGroup->getID());
        $this->assertNotEmpty($accountGroup);
        $this->assertNotEmpty($accountGroup->getOrganization());
    }
}
