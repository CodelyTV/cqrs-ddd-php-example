<?php

namespace CodelyTv\Context\Course\Module\Course\Domain;

use CodelyTv\Exception\DomainError;
use CodelyTv\Shared\Domain\CourseId;

final class CourseNotFound extends DomainError
{
    private $id;

    public function __construct(CourseId $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    public function errorCode(): string
    {
        return 'course_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The course <%s> has not been found', $this->id->value());
    }
}
