<?php

namespace App\Controller\Admin;

use App\Entity\Cards;
use App\Enum\Game;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CardsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cards::class;
    }

    // ----------------------------------------
    public function configureFields(string $pageName): iterable
    {
        $context = $this->getContext();
        $request = $context->getRequest();
        $entity  = $context->getEntity()?->getInstance();

        // priorité : POST > entity
        $formData = $request->request->all('Cards');
        $gameValue = $formData['game']
            ?? $entity?->getGame()
            ?? null;

        $areaChoices = [];

        if ($gameValue) {
            $game = Game::from($gameValue);

            $areaChoices = array_combine(
                $game->areas(),
                $game->areas()
            );
        }




        return [
            // --------------------
            TextField::new('name'),
            // ->setLabel('name')


            // --------------------
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
                ->setChoices(Game::choices())
                ->renderAsNativeWidget(),

            ChoiceField::new('areas')
                ->setLabel('Area')
                ->setChoices([
                    'Howling Cliffs' => 'Howling Cliffs',
                    'Dirtmouth' => 'Dirtmouth',
                    'Forgotten Crossroad' => 'Forgotten Crossroad',
                    'Fungal Wastes' => 'Fungal Wastes',
                    'City of Tears' => 'City of Tears',
                    'Soul Sanctum' => 'Soul Sanctum',
                    'Pleasure House' => 'Pleasure House',
                    'Watcher\'s Spire' => 'Watcher\'s Spire',
                    'Royal Waterways' => 'Royal Waterways',
                    'Cristal Peak' => 'Cristal Peak',
                    'Kingdom\'s Edge' => 'Kingdom\'s Edge',
                    'Colosseum of Fool' => 'Colosseum of Fool',
                    'Resting Grounds' => 'Resting Grounds',
                    'Fog Canyon' => 'Fog Canyon',
                    'Queen\'s Gardens' => 'Queen\'s Gardens',
                    'Deepnest' => 'Deepnest',
                    'The Hive' => 'The Hive',
                    'Ancient Bassin' => 'Ancient Bassin',
                    'Palace Ground\'s' => 'Palace Ground\'s',
                    'The Abyss' => 'The Abyss',

                    'Moss Grotto' => 'Moss Grotto',
                    'The Marrow' => 'The Marrow',
                    'Hunter\'s March' => 'Hunter\'s March',
                    'Deep Dock\'s' => 'Deep Dock\'s',
                    'Far Fields' => 'Far Fields',
                    'Greymoor' => 'Greymoor',
                    'Wisp Thicket' => 'Wisp Thicket',
                    'Verdiana' => 'Verdiana',
                    'Bellhart' => 'Bellhart',
                    'Shellwood' => 'Shellwood',
                    'Wormways' => 'Wormways',
                    'Blasted Steps' => 'Blasted Steps',
                    'Sand of Karak' => 'Sand of Karak',
                    'Sinner\'s Road' => 'Sinner\'s Road',
                    'Bilewater' => 'Bilewater',
                    'Putrified Ducts' => 'Putrified Ducts',
                    'Grand Gate' => 'Grand Gate',
                    'Underworks' => 'Underworks',
                    'Citadel-Choral Chambers' => 'Citadel-Choral Chambers',
                    'Citadel-Whiteward' => 'Citadel-Whiteward',
                    'Citadel-Cogwork Core' => 'Citadel-Cogwork Core',
                    'Citadel-Whispering Vaults' => 'Citadel-Whispering Vaults',
                    'Citadel-High Halls' => 'Citadel-High Halls',
                    'Citadel-Memorium' => 'Citadel-Memorium',
                    'The Slab' => 'The Slab',
                    'Mount Fay' => 'Mount Fay',
                    'The Cradle' => 'The Cradle',
                   

                ])
                ->renderAsNativeWidget()
                ->onlyOnForms(),

            // --------------------
            MoneyField::new('price')
                ->setCurrency('EUR')
                ->setNumDecimals(2)
                ->setStoredAsCents(false),
        ];
    }

    // ----------------------------------------
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

    // ----------------------------------------
    private function handleImageUpload(Cards $entity): void
    {
        /** @var UploadedFile|null $file */
        $file = $this->getContext()->getRequest()->files->get('Cards')['picture'] ?? null;

        if ($file) {
            $filename = uniqid() . '.' . $file->guessExtension();
            $file->move('assets/img', $filename);
            $entity->setPicture($filename);
        }
    }
}
