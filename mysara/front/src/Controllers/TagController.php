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
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MySara\Common\Models\Tag;
use MySara\Common\Repositories\ArticleRepo;
use MySara\Common\Repositories\TagRepo;

class TagController extends Controller
{
    /**
     * @return RedirectResponse
     * @throws Exception
     */
    public function index(): RedirectResponse
    {
        return redirect()->to(front_route('articles.index'));
    }

    /**
     * @param  Tag  $tag
     * @return mixed
     * @throws Exception
     */
    public function show(Tag $tag): mixed
    {
        $tags     = TagRepo::getInstance()->list(['active' => true]);
        $articles = ArticleRepo::getInstance()->list(['active' => true, 'tag_id' => $tag->id]);

        $data = [
            'slug'     => $tag->slug,
            'tag'      => $tag,
            'tags'     => $tags,
            'articles' => $articles,
        ];

        return inno_view('tags.show', $data);
    }

    /**
     * @param  Request  $request
     * @return mixed
     * @throws Exception
     */
    public function slugShow(Request $request): mixed
    {
        $slug     = $request->slug;
        $tag      = TagRepo::getInstance()->builder(['active' => true])->where('slug', $slug)->firstOrFail();
        $tags     = TagRepo::getInstance()->list(['active' => true]);
        $articles = ArticleRepo::getInstance()->list(['active' => true, 'tag_id' => $tag->id]);

        $data = [
            'slug'     => $slug,
            'tag'      => $tag,
            'tags'     => $tags,
            'articles' => $articles,
        ];

        return inno_view('tags.show', $data);
    }
}
