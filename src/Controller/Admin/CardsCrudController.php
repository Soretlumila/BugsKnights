<?php

namespace App\Controller\Admin;

use App\Entity\Cards;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class CardsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cards::class;
    }




    // ----------------------------------------
    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('picture')
                ->setBasePath('/assets/img')
                ->onlyOnIndex(),

            TextField::new('picture')
                ->setFormType(\Symfony\Component\Form\Extension\Core\Type\FileType::class)
                ->setFormTypeOptions([
                    'mapped' => false,
                    'required' => $pageName === 'new',
                ])
                ->onlyOnForms(),

            ChoiceField::new('game')
                ->setLabel('Game')
                ->setChoices([
                    'Hollow Knight' => 'Hollow Knight',
                    'SilkSong' => 'SilkSong',

                ])
                ->renderAsNativeWidget(),
            ChoiceField::new('areas')
                ->setLabel('Area')
                ->setChoices([
                    'Soul Sanctum' => 'Soul Sanctum',
                    'USA' => 'us',
                    'Japan' => 'jp',
                    'Worldwide' => 'world',
                ])
                ->renderAsNativeWidget(),

            MoneyField::new('price')
                ->setCurrency('EUR')
                ->setNumDecimals(2)
                ->setStoredAsCents(false),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        $this->handleImageUpload($entityInstance);
        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        $this->handleImageUpload($entityInstance);
        parent::updateEntity($em, $entityInstance);
    }

    private function handleImageUpload($entityInstance)
    {
        /** @var UploadedFile $file */
        $file = $this->getContext()->getRequest()->files->get('Cards')['picture'] ?? null;

        if ($file) {
            $newFilename = uniqid() . '.' . $file->guessExtension();
            $file->move('assets/img', $newFilename);
            $entityInstance->setPicture($newFilename);
        }
    }
}
