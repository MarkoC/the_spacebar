<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
class ArticleAdminController extends AbstractController
{


    public function __construct()
    {

    }

    /**
    *@Route("/admin/article/new")
    */
    public function new(EntityManagerInterface $em)
    {
        die('todo');
        return new Response(sprintf(
            'Hiya! New Article id: #%d slug: %s',
            $article->getId(),
            $article->getSlug()
        ));
    }

}
