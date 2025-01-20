<?php

declare(strict_types=1);

namespace Core\Abstract;

use Core\Trait\ConvertsSchemaToArray;
use Doctrine\ORM\Mapping\Entity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use JsonException;
use stdClass;

/**
 * Class BaseResource
 *
 * @package Core\Http\Resources
 * @property JsonResource $collection_data
 * @property-read Entity $resource
 * @method Collection get(string $string, $default = null)
 * @method Collection gets(string $string, $default = null)
 * @method Collection stringSerialize(string $name)
 * @method LengthAwarePaginator currentPage()
 * @method LengthAwarePaginator url($url)
 * @method LengthAwarePaginator firstItem()
 * @method LengthAwarePaginator lastPage()
 * @method LengthAwarePaginator nextPageUrl()
 * @method LengthAwarePaginator path()
 * @method LengthAwarePaginator perPage()
 * @method LengthAwarePaginator previousPageUrl()
 * @method LengthAwarePaginator lastItem()
 * @method LengthAwarePaginator total()
 * @method LengthAwarePaginator hasPages()
 * @method LengthAwarePaginator items()
 */
abstract class AbstractResource extends JsonResource
{
    use ConvertsSchemaToArray;

    /**
     * @var string
     */
    public static $wrap = '_payload';

    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public bool $preserveKeys = true;

    /**
     * @var string|JsonResource
     */
    protected string|JsonResource $collectionClass = '';

    /**
     * Set the string that should wrap the outer-most resource array.
     *
     * @param string $value
     * @return void
     */
    public static function wrap($value): void
    {
        if (property_exists(self::class, 'wrap')) {
            JsonResource::wrap(static::$wrap);
        }

        JsonResource::wrap(null);
    }

    /**
     * @param string $class
     * @return $this
     */
    public function collectionClass(string $class = ''): AbstractResource
    {
        $this->collectionClass = $class;

        return $this;
    }

    /**
     * @return false|string
     * @throws JsonException
     */
    public function eObject(): false|string
    {
        return json_encode(new stdClass(), JSON_THROW_ON_ERROR);
    }
}
