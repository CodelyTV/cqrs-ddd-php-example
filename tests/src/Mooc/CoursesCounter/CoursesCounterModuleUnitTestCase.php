<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Mooc\CoursesCounter;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounter;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterId;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterInitializer;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterRepository;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class CoursesCounterModuleUnitTestCase extends UnitTestCase
{
    private $repository;
    private $initializer;

    protected function shouldSave(CoursesCounter $course): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->once()
            ->with($this->similarTo($course))
            ->andReturnNull();
    }

    protected function shouldSearch(?CoursesCounter $counter): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->once()
            ->andReturn($counter);
    }

    /** @return CoursesCounterRepository|MockInterface */
    protected function repository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(CoursesCounterRepository::class);
    }

    /** @return CoursesCounterInitializer|MockInterface */
    protected function initializer(): MockInterface
    {
        return $this->initializer = $this->initializer ?: $this->mock(CoursesCounterInitializer::class);
    }

    protected function shouldInitialize(CoursesCounterId $coursesCounterId): void
    {
        $this->initializer()
            ->shouldReceive('__invoke')
            ->once()
            ->withNoArgs()
            ->andReturn(CoursesCounter::initialize($coursesCounterId));
    }
}