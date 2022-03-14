<?php

namespace Tests\Unit;

use Exception;
use Tests\TestCase;
use App\Repositories\Repository;
use App\Repositories\Data;

class FormTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new Repository();
        $this->repository->createDatabase();
    }
}