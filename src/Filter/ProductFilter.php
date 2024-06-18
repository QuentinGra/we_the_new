<?php

namespace App\Filter;

class ProductFilter
{
    public function __construct(
        private ?string $name = null,
        private ?float $price = null,
        private int $page = 1,
        private int $limit = 12,
        private ?string $sort = null,
        private ?string $direction = null,
        private ?int $min = null,
        private ?int $max = null,
    ) {
    }

    /**
     * Get the value of name.
     *
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     * @param ?string $name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price.
     *
     * @return ?float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * Set the value of price.
     *
     * @param ?float $price
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of page.
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Set the value of page.
     */
    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of limit.
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Set the value of limit.
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get the value of sort.
     *
     * @return ?string
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * Set the value of sort.
     *
     * @param ?string $sort
     */
    public function setSort(?string $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get the value of direction.
     *
     * @return ?string
     */
    public function getDirection(): ?string
    {
        return $this->direction;
    }

    /**
     * Set the value of direction.
     *
     * @param ?string $direction
     */
    public function setDirection(?string $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get the value of min.
     *
     * @return ?int
     */
    public function getMin(): ?int
    {
        return $this->min;
    }

    /**
     * Set the value of min.
     *
     * @param ?int $min
     */
    public function setMin(?int $min): self
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get the value of max.
     *
     * @return ?int
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * Set the value of max.
     *
     * @param ?int $max
     */
    public function setMax(?int $max): self
    {
        $this->max = $max;

        return $this;
    }
}
