<?php namespace App\Controllers;

use App\Services\Pages\PageDataFactory;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;

class PageController extends Controller {

    const SUBTEMPLATE = 'page';

    public function actionView(Response $response, $alias)
    {

        $pageData = $this->pageDataFactory->build(PageDataFactory::TYPE_PAGE, $alias);

        if (!$pageData) {
            return $response->withRedirect('/error/not-found');
        }

        $categoryList = $this->categoryListService->getAllCategories();
        $tagList = $this->tagListService->getAllTags();

        return $this->view->render($response, 'layout.php', [
            'subtemplate' => self::SUBTEMPLATE,
            'pageData' => $pageData,
            'categoryList' => $categoryList,
            'tagList' => $tagList
        ]);

    }

}