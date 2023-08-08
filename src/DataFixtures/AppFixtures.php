<?php

namespace App\DataFixtures;

use App\Service\DataService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @var DataService
     */
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function load(ObjectManager $manager): void
    {
        try {
            $this->dataService->import();
        } catch (\Exception $e) {
            throw new $e;
        }
    }
}
