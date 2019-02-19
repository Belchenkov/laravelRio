<?php

namespace Corp\Http\Controllers;

use Corp\Menu;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\CommentsRepository;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\PortfoliosRepository;

class ArticlesController extends SiteController
{
    public function __construct(
        PortfoliosRepository $p_rep,
        CommentsRepository $c_rep,
        ArticlesRepository $a_rep
    ) {
        parent::__construct(new MenusRepository(new Menu()));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;
        $this->bar = 'right';
        $this->template = env('THEME') . '.articles';
    }

    public function index()
    {
        $articles = $this->getArticles();
        $content = view(env('THEME') . '.articles_content')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));

        $this->contentRightBar = view(env('THEME') . '.articlesBar')->with([
            'comments' => $comments,
            'portfolios' => $portfolios
        ]);

        return $this->renderOutput();
    }

    public function getArticles($alias = false)
    {
        $articles = $this->a_rep->get(
            ['id', 'title', 'alias', 'created_at', 'img', 'desc', 'user_id', 'category_id'],
            false,
            true
        );

        if ($articles) {
            $articles->load('user', 'category', 'comments');
        }

        return $articles;
    }

    public function getComments($take)
    {
        return $this->c_rep->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take);
    }

    public function getPortfolios($take)
    {
        return $this->p_rep->get(['title', 'text', 'alias', 'customer', 'img', 'filter_alias'], $take);
    }
}
