<?php

namespace App\Controller;

use PDOException;
use App\Model\Article;
use App\Dao\ArticleDao;

class ArticleController
{
    public function index()
    {
        try {
            $articleDao = new ArticleDao();
            $articles = $articleDao->getAll();
            require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'index.html.php']);
        } catch (PDOException $e) {
            echo "Oops ! I think something went wrong";
            echo "<br>";
            echo $e->getMessage();
            die;
        }
    }

    public function new()
    {
        if (!isset($_SESSION['user'])) { //if it doesn't exist a session user logged
            header('Location: /'); //head me back to the homepage
            die;
        }

        /**
         * Tableau d'arguments qui va nous permettre de récupérer les données souhaitées dans filter_input_array
         * Les données qu'on souhaite récupérer sont : "title" et "content"
         * Et on a décidé de passer des filtres avec leurs options à "title"
         */
        //The datas I receive from the form completed by my user
        $args = [
            "title" => [],
            'content' => []
        ];
        //I get the datas via the form (and method POST) and store them in $article_post
        $article_post = filter_input_array(INPUT_POST, $args);

        /** Vérifies que les variables existent et qu'elles ne sont pas NULL */
        if (isset($article_post['title']) && isset($article_post['content'])) {
            /** Vérifies que les variables sont vide (false, NULL, 0, "", []) */
            if (empty(trim($article_post['title']))) {
                $error_messages[] = "Titre inexistant";
            }
            if (empty(trim($article_post['content']))) {
                $error_messages[] = "Contenu inexistant";
            }

            /** Vérifies que $error_messages n'existe pas */
            if (!isset($error_messages)) {
                $article = new Article();
                $article->setTitle($article_post['title'])
                    ->setContent($article_post['content']);
                $articleDao = new ArticleDao();
                $articleDao->new($article);
                /** Rediriges vers la page du nouvel article ajouté */
                header(sprintf('Location: /article/show/%d', $article->getIdArticle()));
                die;
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'new.html.php']);
    }

    public function show(int $id)
    {
        $articleDao = new ArticleDao();
        $article = $articleDao->getById($id);

        if (is_null($article)) {
            header('Location: /');
            die;
        }
        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'show.html.php']);
    }

    public function edit(int $id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }
        $articleDao = new ArticleDao();
        $article = $articleDao->getById($id);

        if (is_null($article)) {
            header('Location: /');
            die;
        }

        /**
         * Tableau d'arguments qui va nous permettre de récupérer les données souhaitées dans filter_input_array
         * Les données qu'on souhaite récupérer sont : "title" et "content"
         * Et on a décidé de passer des filtres avec leurs options à "title"
         */
        $args = [
            "title" => [],
            'content' => []
        ];
        $article_post = filter_input_array(INPUT_POST, $args);

        /** Vérifies que les variables existent et qu'elles ne sont pas NULL */
        if (isset($article_post['title']) && isset($article_post['content'])) {
            /** Vérifies que les variables sont vide (false, NULL, 0, "", []) */
            if (empty(trim($article_post['title']))) {
                $error_messages[] = "Titre inexistant";
            }
            if (empty(trim($article_post['content']))) {
                $error_messages[] = "Contenu inexistant";
            }

            /** Vérifies que $error_messages n'existe pas */
            if (!isset($error_messages)) {
                $article->setTitle($article_post['title'])
                    ->setContent($article_post['content']);
                $articleDao->edit($article);
                /** Rediriges vers la page de l'article édité */
                header(sprintf('Location: /article/show/%d', $article->getIdArticle()));
                die;
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'edit.html.php']);
    }

    public function delete(int $id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }
        $articleDao = new ArticleDao();
        $articleDao->delete($id);
        header('Location: /');
        die;
    }
}
