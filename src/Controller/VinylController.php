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
        $tracks = [
            ['song' => 'Purple Haze', 'artist' => 'Jimi Hendrix'],
            ['song' => 'The Wind Cries Mary', 'artist' => 'Jimi Hendrix'],
            ['song' => 'All Along the Watchtower', 'artist' => 'Jimi Hendrix'],
            ['song' => 'Hey Joe', 'artist' => 'Jimi Hendrix'],
            ['song' => 'Little Wing', 'artist' => 'Jimi Hendrix'],
            ['song' => 'Foxy Lady', 'artist' => 'Jimi Hendrix'],
            ['song' => 'Crosstown Traffic', 'artist' => 'Jimi Hendrix'],
            ['song' => 'Fire', 'artist' => 'Jimi Hendrix'],
            ['song' => 'Red House', 'artist' => 'Jimi Hendrix'],
            ['song' => 'Voodoo Child', 'artist' => 'Jimi Hendrix'],
        ];

        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'PB & Jams',
            'tracks' => $tracks,
        ]); 
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