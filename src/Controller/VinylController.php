<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function Symfony\Component\String\u; 

class VinylController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(): Response
    {
        return new Response('Title PB & Jams');
    }

    #[Route('/browse/{slug}', name: 'vinyl_genre')]
    public function browse(string $slug = null): Response
    {

        if ($slug) {
            $title = 'Genre: '.u(str_replace('-', ' ', $slug))->title(true);
        }
        else {
            $title = 'Browse all genres';
        }

        return new Response($title);
    }
}