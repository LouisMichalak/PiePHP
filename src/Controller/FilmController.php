<?php

namespace App\Controller;

use Core\Controller;
use App\Model\GenreModel;
use App\Model\FilmModel;

final class FilmController extends Controller
{
    public function addAction()
    {
        $genreModel = new GenreModel();
        $genres = $genreModel->fetch();
        self::render('add', ['genres' => $genres]);
    }

    public function addValidationAction()
    {
        $filmModel = new FilmModel();
        $nom = $this->request->getParam('nom');
        $resume = $this->request->getParam('resume');
        $duree = $this->request->getParam('duree');
        $genre = $this->request->getParam('genre');
        if($nom !== null && $nom !== '') {
            if(!empty($filmModel->fetch(['WHERE' => 'nom = \'' . $nom . '\''])[0])) {
                echo 'Un film à ce nom est deja inscrit !';
            } else {
                $filmModel->setNom($nom);
                if($duree !== null)
                    $filmModel->setDuree($duree === null ? 'null' : $duree);
                if($resume !== null)
                    $filmModel->setResume($resume);
                if($genre !== null)
                    $filmModel->setGenre_id($genre);
                $input = $filmModel->save();
                if($input !== false)
                    echo 'Film ajouté ';
                else
                    echo 'Erreur dans le traitement de la requête';
            }
        } else {
            echo 'Le nom du film doit être inscrit';
        }
    }

    public function showAction($id)
    {
        $filmModel = new FilmModel();
        $film = $filmModel->setId($id)->getRecord();
        self::render('show', ['film' => $film]);
    }
}
