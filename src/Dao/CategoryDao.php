<?php

namespace App\Dao;

use PDO;
use Core\AbstractDao;
use App\Model\Category;

class CategoryDao extends AbstractDao
{
    /**
     * Récupère de la base de données tous les articles
     *
     * @return Category[] Tableau d'objet Article
     */
    public function getAll(): array
    {
        $sth = $this->dbh->prepare("SELECT * FROM `categorie`");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        //$result contains all my articles fetched as an associtaive array of assoc arrays  [[], [],[]...]

        for ($i = 0; $i < count($result); $i++) {
            $a = new Category();  //Here, I create the object Article
            $result[$i] = $a->setIdCategory($result[$i]['id_category'])
            //I set the values to my new object matching the values in my db
                ->setName($result[$i]['name'])
                ->setDescription($result[$i]['description']);
        }
        return $result; //return the final associative array of objects
        //[{},{},{}...]
    }

    /**
     * Récupère de la base de données un article en fonction de son id ou null si l'article n'existe pas
     *
     * @param int $id Identifiant de l'article qu'on doit récupérer de la bdd
     * @return Article|null Objet de l'article récupéré en bdd ou null
     */
    public function getById(int $id): ?Category  //'show' of controller : to display one category
    {
        $sth = $this->dbh->prepare("SELECT * FROM `categorie` WHERE id_category = :id_category");
        $sth->execute([":id_category" => $id]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) return null;

        $a = new Category();
        return $a->setIdCategory($result['id_category'])
            ->setName($result['name'])
            ->setDescription($result['description']);
    }



    /**
     * Ajoute un article à la base de données et assigne l'id de l'article créé
     *
     * @param Category $article Objet de l'article à ajouter à la bdd
     */
    public function new(Category $category): void
    {
        $sth = $this->dbh->prepare(
            "INSERT INTO `categorie` (name, description)
                                        VALUES (:name, :description)"
        );
        $sth->execute([ //i save the new category in the db with AutoIncrement
            ':name' => $category->getName(),
            ':description' => $category->getDescription()
        ]);
        //this function allows me to get the id of the last category created above
        $category->setIdCategory($this->dbh->lastInsertId());
    }



    /**
     * Edite un article de la base de données
     *
     * @param Category $article Objet de l'article à éditer
     */
    public function edit(Category $category): void
    {
        $sth = $this->dbh->prepare(
            "UPDATE `categorie` SET name = :name, description = :description WHERE id_category = :id_category"
        );
        $sth->execute([
            ':name' => $category->getName(),
            ':description' => $category->getDescription(),
            ':id_category' => $category->getIdCategory()
        ]);
    }

    /**
     * Supprime un article de la base de données
     *
     * @param int $id Identifiant de l'article à supprimer
     */
    public function delete(int $id): void
    {
        $sth = $this->dbh->prepare("DELETE FROM `categorie` WHERE id_category = :id_category");
        $sth->execute([":id_category" => $id]);
    }
}
