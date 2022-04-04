<?php declare(strict_types=1);

namespace App\Serializer;

use App\DTO\User\CreateUserDTO;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class UserDenormalizer implements DenormalizerInterface
{
    public const SUPPORT_TYPES = [CreateUserDTO::class];

    private ObjectNormalizer $normalizer;

    public function __construct()
    {
        $this->normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return $this->normalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return in_array($type, self::SUPPORT_TYPES);
    }
}
