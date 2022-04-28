<?php

namespace App\Controller;

use PDOException;
use App\Model\Category;
use App\Dao\CategoryDao;

class CategoryController
{
    public function index()
    {
        try {
            $categoryDao = new CategoryDao();
            $categories = $categoryDao->getAll();
            require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'category', 'index.html.php']);
        } catch (PDOException $e) {
            echo "Oops ! I think something went wrong";
            echo "<br>";
            echo $e->getMessage();
            die;
        }
    }

    public function new()
    {
        // if (!isset($_SESSION['user'])) { //if it doesn't exist a session user logged
        //     header('Location: /'); //head me back to the homepage
        //     die;
        // }

        /**
         * Tableau d'arguments qui va nous permettre de récupérer les données souhaitées dans filter_input_array
         * Les données qu'on souhaite récupérer sont : "title" et "content"
         * Et on a décidé de passer des filtres avec leurs options à "title"
         */
        //The datas I receive from the form completed by my user
        $args = [
            "name" => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
            ],
            'description' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
            ]
        ];
        //I get the datas via the form (and method POST) and store them in $category_post
        $category_post = filter_input_array(INPUT_POST, $args);

        /** Vérifies que les variables existent et qu'elles ne sont pas NULL */
        if (isset($category_post['name']) && isset($category_post['description'])) {
            /** Vérifies que les variables sont vide (false, NULL, 0, "", []) */
            if (empty(trim($category_post['name']))) {
                $error_messages[] = "Name inexistant";
            }
            if (empty(trim($category_post['description']))) {
                $error_messages[] = "Description inexistant";
            }

            /** Vérifies que $error_messages n'existe pas */
            if (!isset($error_messages)) {
                $category = new Category();
                $category->setName($category_post['name'])
                    ->setDescription($category_post['description']);
                $categoryDao = new CategoryDao();
                $categoryDao->new($category);
                /** Rediriges vers la page du nouvel category ajouté */
                header(sprintf('Location: /category/show/%d', $category->getIdCategory()));
                die;
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'category', 'new.html.php']);
    }



    public function show(int $id)
    {
    
        $categoryDao = new CategoryDao();
        $category = $categoryDao->getById($id);

        if (is_null($category)) {
            header('Location: /');
            die;
        }
        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'category', 'show.html.php']);
    }




    public function edit(int $id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }
        $categoryDao = new CategoryDao();
        $category = $categoryDao->getById($id);

        if (is_null($category)) {
            header('Location: /');
            die;
        }

        /**
         * Tableau d'arguments qui va nous permettre de récupérer les données souhaitées dans filter_input_array
         * Les données qu'on souhaite récupérer sont : "name" et "description"
         * Et on a décidé de passer des filtres avec leurs options à "title"
         */
        $args = [
            "name" => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
            ],
            'description' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
            ]
        ];
        $category_post = filter_input_array(INPUT_POST, $args);

        /** Vérifies que les variables existent et qu'elles ne sont pas NULL */
        if (isset($category_post['name']) && isset($category_post['description'])) {
            /** Vérifies que les variables sont vide (false, NULL, 0, "", []) */
            if (empty(trim($category_post['name']))) {
                $error_messages[] = "Name inexistant";
            }
            if (empty(trim($category_post['description']))) {
                $error_messages[] = "Description inexistante";
            }

            /** Vérifies que $error_messages n'existe pas */
            if (!isset($error_messages)) {
                $category->setName($category_post['name'])
                    ->setDescription($category_post['description']);
                $categoryDao->edit($category);
                /** Rediriges vers la page de la category édité */
                header(sprintf('Location: /category/show/%d', $category->getIdCategory()));
                die;
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'category', 'edit.html.php']);
    }

    public function delete(int $id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }
        $categoryDao = new CategoryDao();
        $categoryDao->delete($id);
        header('Location: /');
        die;
    }
}
