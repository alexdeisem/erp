<?php declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Unique extends Constraint
{
    public string $entity;
    public string $column;
    public $message = "{{ column }} '{{ value }}' is already exists";

    public function __construct(string $entity, string $column, $options = null, array $groups = null, $payload = null)
    {
        parent::__construct($options, $groups, $payload);

        $this->entity = $entity;
        $this->column = $column;
    }
}
