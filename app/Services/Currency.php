<?php

namespace App\Services;

class Currency
{
    private $id;
    private $name;
    private $shortName;
    private $actualCourse;
    private $actualCourseDate;
    private $isActive;

    public function __construct(
        int $id,
        string $name,
        string $shortName,
        float $actualCourse,
        \DateTimeInterface $actualCourseDate,
        bool $isActive)
    {
        $this->id = $id;
        $this->name = $name;
        $this->shortName = $shortName;
        $this->actualCourse = $actualCourse;
        $this->actualCourseDate = $actualCourseDate;
        $this->isActive = $isActive;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): void
    {
        $this->shortName = $shortName;
    }

    public function getActualCourse(): float
    {
        return $this->actualCourse;
    }

    public function setActualCourse(float $actualCourse): void
    {
        $this->actualCourse = $actualCourse;
    }

    public function getActualCourseDate(): \DateTimeInterface
    {
        return $this->actualCourseDate;
    }

    public function setActualCourseDate(\DateTimeInterface $actualCourseDate): void
    {
        $this->actualCourseDate = $actualCourseDate;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}
