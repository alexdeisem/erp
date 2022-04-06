<?php declare(strict_types=1);

namespace App\Validator;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueValidator extends ConstraintValidator
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Unique) {
            throw new UnexpectedTypeException($constraint, Unique::class);
        }

        // пользовательские ограничения должны игнорировать пустые значения и null, чтобы
        // позволить другим ограничениям (NotBlank, NotNull, и др.) позаботиться об этом
        if (null === $value || '' === $value) {
            return;
        }

        $repository = $this->doctrine->getManager()->getRepository($constraint->entity);
        $existsValue = $repository->findOneBy([$constraint->column => $value]);

        if ($existsValue) {
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ column }}', ucfirst($constraint->column))
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
