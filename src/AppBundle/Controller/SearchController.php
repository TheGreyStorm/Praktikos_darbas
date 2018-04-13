<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/12/2018
 * Time: 12:04 PM
 */

namespace AppBundle\Controller;



use AppBundle\Entity\Question;
use AppBundle\Entity\Search;
use AppBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends Controller
{
    /**
     * @Route("/search/", name="search_results")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        dump($request);
        $search = new Search();

        $searchBar = $this->createForm(SearchType::class, $search);
        $searchBar->handleRequest($request);


         /*   if ($request->isMethod('POST')) {
        $searchBar->submit($request->request->get('search'));
    }*/

        $search = $searchBar->getData();

        $elasticaManager = $this->get('fos_elastica.manager');
        $repository = $elasticaManager->getRepository(Search::class);
        $results = $repository->search($search);

        return $this->render('Faq/search.html.twig', array(
            'request' =>$request,
            'result' => $results,
            'form' => $search
        ));
    }
}