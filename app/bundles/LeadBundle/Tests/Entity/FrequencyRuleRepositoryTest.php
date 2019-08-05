<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic, Inc.
 *
 * @link        https://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\LeadBundle\Tests\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Mautic\LeadBundle\Entity\FrequencyRuleRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FrequencyRuleRepositoryTest extends KernelTestCase
{
    /** @var FrequencyRuleRepository */
    protected $repository;

    protected function setUp()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mapping = $this->getMockBuilder(ClassMetadata::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new FrequencyRuleRepository($em, $mapping);
    }

    public function testValidateDefaultParameters()
    {
        $method = new \ReflectionMethod(FrequencyRuleRepository::class, 'validateDefaultParameters');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($this->repository, false, false));
        $this->assertFalse($method->invoke($this->repository, false, true));
        $this->assertFalse($method->invoke($this->repository, true, false));
        $this->assertTrue($method->invoke($this->repository, true, true));
    }
}
