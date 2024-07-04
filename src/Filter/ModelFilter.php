<?php

namespace App\Filter;

class ModelFilter
{
    public function __construct(
        private ?string $search = null,
        private array $brands = [],
        private int $page = 1,
        private ?int $limit = 9,
        private ?string $sort = null,
        private ?string $direction = null,
    ) {
    }

    /**
     * Get the value of search
     *
     * @return ?string
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * Set the value of search
     *
     * @param ?string $search
     *
     * @return self
     */
    public function setSearch(?string $search): self
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get the value of brands
     *
     * @return array
     */
    public function getBrands(): array
    {
        return $this->brands;
    }

    /**
     * Set the value of brands
     *
     * @param array $brands
     *
     * @return self
     */
    public function setBrands(array $brands): self
    {
        $this->brands = $brands;

        return $this;
    }

    /**
     * Get the value of page
     *
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @param int $page
     *
     * @return self
     */
    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of limit
     *
     * @return ?int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set the value of limit
     *
     * @param ?int $limit
     *
     * @return self
     */
    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get the value of sort
     *
     * @return ?string
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * Set the value of sort
     *
     * @param ?string $sort
     *
     * @return self
     */
    public function setSort(?string $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get the value of direction
     *
     * @return ?string
     */
    public function getDirection(): ?string
    {
        return $this->direction;
    }

    /**
     * Set the value of direction
     *
     * @param ?string $direction
     *
     * @return self
     */
    public function setDirection(?string $direction): self
    {
        $this->direction = $direction;

        return $this;
    }
}
