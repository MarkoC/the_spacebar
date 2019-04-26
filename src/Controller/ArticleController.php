<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{

    private $isDebug;
    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
    *@Route("/", name="app_homepage")
    */
    public function homepage(ArticleRepository $repository)
    {

        $articles = $repository->findAllPublishedOrderedByNewest();
        return $this->render('article/homepage.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
    * @Route("/news/{slug}", name="article_show")
    */
    public function show(Article $article, MarkdownHelper $markdownHelper, SlackClient $slack)
    {
      if ($article->getSlug() === 'khaaaaaan') {
                $slack->sendMessage('pero', 'Bok, kak si?');
              }



                return $this->render('article/show.html.twig', [
                  'article' => $article,
                  'comments' => ['Neki komentar' , 'Još malo komentara']
        ]);
    }

    /**
    * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
    */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        // TODO - actually heart/unheart the article!
        $article->incrementHeartCount();
        $em->flush();
        $logger->info('Article is being hearted! NOW');

        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}
