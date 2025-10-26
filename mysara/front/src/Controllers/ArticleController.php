<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Front\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MySara\Common\Models\Article;
use MySara\Common\Repositories\ArticleRepo;
use MySara\Common\Repositories\CatalogRepo;
use MySara\Common\Repositories\TagRepo;

class ArticleController extends Controller
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function index(): mixed
    {
        $data = [
            'articles' => ArticleRepo::getInstance()->list(['active' => true]),
            'catalogs' => CatalogRepo::getInstance()->list(['active' => true]),
            'tags'     => TagRepo::getInstance()->list(['active' => true]),
        ];

        return inno_view('articles.index', $data);
    }

    /**
     * @param  Article  $article
     * @return mixed
     * @throws \Exception
     */
    public function show(Article $article): mixed
    {
        if (! $article->active) {
            abort(404);
        }

        return $this->renderArticleDetail($article);
    }

    /**
     * @param  Request  $request
     * @return mixed
     * @throws \Exception
     */
    public function slugShow(Request $request): mixed
    {
        $slug    = $request->slug;
        $article = ArticleRepo::getInstance()->builder(['active' => true])->where('slug', $slug)->firstOrFail();

        return $this->renderArticleDetail($article, ['slug' => $slug]);
    }

    /**
     * Render article detail page
     * @param  Article  $article  Article object
     * @param  array  $extraData  Extra data
     * @return mixed
     * @throws \Exception
     */
    private function renderArticleDetail(Article $article, array $extraData = []): mixed
    {
        $article->increment('viewed');

        $articleRepo = ArticleRepo::getInstance();

        $data = array_merge([
            'article'         => $article,
            'catalogs'        => CatalogRepo::getInstance()->list(['active' => true]),
            'relatedArticles' => $articleRepo->getRelatedArticles($article, 5),
            'relatedProducts' => $articleRepo->getRelatedProducts($article, 8),
        ], $extraData);

        return inno_view('articles.show', $data);
    }
}
