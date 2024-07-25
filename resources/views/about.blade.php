<!-- resources/views/about.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Qui sommes-nous ?</h1>

    <div class="row">
        <div class="col-md-6 p-4 rounded shadow-sm bg-light">
            <h2>Notre Histoire</h2>
            <p>
                Fondée en 2015, ImmoGoGo est née d'une vision commune : révolutionner la manière dont les gens trouvent leur maison idéale. Nous avons commencé avec une petite équipe passionnée et un rêve ambitieux de simplifier le processus d'achat, de vente et de location de biens immobiliers.
            </p>
            <p>
                Inspiré par les défis rencontrés dans le secteur immobilier traditionnel, ImmoGoGo a été conçu pour offrir une expérience utilisateur fluide, transparente et moderne. Nous avons intégré des outils innovants et des fonctionnalités intelligentes pour rendre chaque étape du parcours immobilier aussi simple et agréable que possible.
            </p>
        </div>
        
        <div class="col-md-6 p-4 rounded shadow-sm bg-light">
            <h2>Notre Mission</h2>
            <p>
                Chez ImmoGoGo, notre mission est de connecter les acheteurs, les vendeurs et les locataires de manière efficace et honnête. Nous croyons que trouver la maison de vos rêves ne devrait pas être un parcours du combattant. C'est pourquoi nous nous engageons à offrir des services personnalisés et à mettre à jour régulièrement notre plateforme avec les dernières propriétés disponibles sur le marché.
            </p>
            <p>
                Notre équipe dévouée travaille sans relâche pour assurer la qualité et la précision des informations que nous fournissons. Nous sommes fiers de notre capacité à anticiper les besoins de nos clients et à proposer des solutions adaptées à chaque situation.
            </p>
        </div>
    </div>

    <div class="mt-4 p-4 rounded shadow-sm bg-light">
        <h2>Nos Valeurs</h2>
        <ul>
            <li><strong>Transparence :</strong> Nous croyons en la transparence totale. Nos utilisateurs méritent de savoir exactement ce qu'ils obtiennent et à quel prix.</li>
            <li><strong>Innovation :</strong> Nous investissons dans les dernières technologies pour offrir une expérience utilisateur de premier ordre.</li>
            <li><strong>Engagement :</strong> Notre équipe est passionnée et dévouée à aider nos clients à trouver leur bien idéal.</li>
            <li><strong>Fiabilité :</strong> Vous pouvez compter sur nous pour vous fournir des informations fiables et précises sur le marché immobilier.</li>
        </ul>
    </div>

    <div class="mt-4 p-4 rounded shadow-sm bg-light">
        <h2>Nous Contacter</h2>
        <p>
            Nous serions ravis de répondre à toutes vos questions ou de vous aider dans votre recherche immobilière. N'hésitez pas à nous contacter par email à <a href="mailto:contact@imogogo.com">contact@imogogo.com</a> ou par téléphone au <strong>0629427275</strong>.
        </p>
        <p>
            Vous pouvez également suivre notre actualité sur les réseaux sociaux pour rester informé des dernières tendances et annonces.
        </p>
    </div>
</div>
@endsection
