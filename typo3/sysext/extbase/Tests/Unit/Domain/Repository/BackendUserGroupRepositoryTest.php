<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3\CMS\Extbase\Tests\Unit\Domain\Repository;

use TYPO3\CMS\Extbase\Domain\Repository\BackendUserGroupRepository;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 */
class BackendUserGroupRepositoryTest extends UnitTestCase
{
    /**
     * @test
     */
    public function initializeObjectSetsRespectStoragePidToFalse()
    {
        $objectManager = $this->createMock(ObjectManagerInterface::class);
        $fixture = new BackendUserGroupRepository($objectManager);
        $querySettings = $this->createMock(Typo3QuerySettings::class);
        $querySettings->expects(self::once())->method('setRespectStoragePage')->with(false);
        $objectManager->expects(self::once())->method('get')->with(Typo3QuerySettings::class)->willReturn($querySettings);
        $fixture->initializeObject();
    }

    /**
     * @test
     */
    public function initializeObjectSetsDefaultQuerySettings()
    {
        $objectManager = $this->createMock(ObjectManagerInterface::class);
        /** @var $fixture \TYPO3\CMS\Extbase\Domain\Repository\BackendUserGroupRepository */
        $fixture = $this->getMockBuilder(BackendUserGroupRepository::class)
            ->setMethods(['setDefaultQuerySettings'])
            ->setConstructorArgs([$objectManager])
            ->getMock();
        $querySettings = $this->createMock(Typo3QuerySettings::class);
        $objectManager->expects(self::once())->method('get')->with(Typo3QuerySettings::class)->willReturn($querySettings);
        $fixture->expects(self::once())->method('setDefaultQuerySettings')->with($querySettings);
        $fixture->initializeObject();
    }
}
