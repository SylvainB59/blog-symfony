<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        // return [
        //     'id',
        //     'title',
        //     'content',
        //     'image',
        //     'createdAt',
        // ];
        
        // return [
        //     Field::new('id'),
        //     Field::new('title'),
        //     Field::new('content'),
        //     Field::new('image'),
        //     Field::new('createdAt'),
        // ];

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('content'),
            ImageField::new('image')
                ->setUploadDir('public/assets/blog/images')
                ->setBasePath('/assets/blog/images')
                ->setRequired(false),
            AssociationField::new('author'),
            AssociationField::new('category'),
        ];
    }
    
}
