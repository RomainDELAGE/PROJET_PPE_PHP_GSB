<?php

use Symfony\Component\HttpFoundation\Request;
use PPE_PHP_GSB\Domain\Comment;
use PPE_PHP_GSB\Domain\Article;
use PPE_PHP_GSB\Domain\Produit;
use PPE_PHP_GSB\Domain\Famille;
use PPE_PHP_GSB\Domain\User;
use PPE_PHP_GSB\Form\Type\CommentType;
use PPE_PHP_GSB\Form\Type\ArticleType;
use PPE_PHP_GSB\Form\Type\ProduitType;
use PPE_PHP_GSB\Form\Type\UserType;


//route appelée de base : authentification
$app->get('/', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('home');

// Login 
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');


// -------------------------------------------------- Section Produit----------------------------------------------

//Renvoie la page des produits  
$app->get('/famille_produits', function () use ($app) {
   
    $produits = $app['dao.produit']->findAll();
    $familles = $app['dao.famille']->findAll();

    //Si la variable issue de la liste déroulante a été renseigné on renvoie seulement les produits de la famille en question
    if(isset($_GET['famille']) && $_GET['famille'] != 0){   
        $famille = $_GET['famille'];
        $produits = $app['dao.produit']->findProduitFamille($famille);
        
    }
    //on affiche la page avec un tableau de produits triables par famille     
    return $app['twig']->render('famille_produit.html.twig', array(
        'produits' => $produits,
        'familles' => $familles ));
})->bind('famille_produits');


// Ajouter une nouveau produit
$app->match('/admin/produit/add', function(Request $request) use ($app) {
    $familles = $app['dao.famille']->findAll();
    $produit = new Produit();
    $produitForm = $app['form.factory']->create(new ProduitType(), $produit);
    $produitForm->handleRequest($request);

    //Si la demande a été soumise (formulaire rempli) on enregistre puis on redirige sur la page produits
    if ($produitForm->isSubmitted() && $produitForm->isValid()) {
        $app['dao.produit']->save($produit);
        $app['session']->getFlashBag()->add('success', 'Le produit a été créé avec succès.');
        return $app->redirect($app['url_generator']->generate('famille_produits'));
    }
    //On affiche le formulaire de produit 
    return $app['twig']->render('produit_form.html.twig', array(
        'familles' => $familles,
        'title' => 'Nouveau produit',
        'produitForm' => $produitForm->createView()));
})->bind('admin_produit_add');


// Editer un produit existant
$app->match('/admin/produit/{ref}/edit', function($ref, Request $request) use ($app) {
    $produit = $app['dao.produit']->find($ref);
    $produitForm = $app['form.factory']->create(new ProduitType(), $produit);
    $produitForm->handleRequest($request);

    //Si la demande a été soumise on enregistre puis on redirige sur la page produits
    if ($produitForm->isSubmitted() && $produitForm->isValid()) {
        $app['dao.produit']->save($produit);
        $app['session']->getFlashBag()->add('success', 'Le produit a été modifié avec succès.');
        return $app->redirect($app['url_generator']->generate('famille_produits'));
    }

    //On affiche par defaut le formulaire de produit rempli avec les données du produit
    return $app['twig']->render('produit_form.html.twig', array(
        'title' => 'Editer un produit',
        'produitForm' => $produitForm->createView()));
})->bind('admin_produit_edit');


// Supprimer un produit
$app->get('/admin/produit/{ref}/delete', function($ref, Request $request) use ($app) {
    // Supprimer le produit
    $app['dao.produit']->delete($ref);
    $app['session']->getFlashBag()->add('success', 'Le produit a été supprimé avec succès.');
    // Redirection sur la page des produits
    return $app->redirect($app['url_generator']->generate('famille_produits'));
})->bind('admin_produit_delete');


// Afficher le détail d'un produit 
$app->get('/produit/{ref}', function ($ref, Request $request) use ($app) {
    $produits = $app['dao.produit']->find($ref);
    return $app['twig']->render('produit.html.twig', array(
        'produits' => $produits));
})->bind('produit');



//----------------------------------------------------------Section Practicients--------------------------------------------



// Section Visiteurs













