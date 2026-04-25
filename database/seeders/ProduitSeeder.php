<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $produits = [
            // Produits pour Jean Dupont (Boulangerie du Coin) - stand_id 1
            [
                'nom' => 'Baguette Tradition',
                'description' => 'Pain croustillant et doré, fait avec de la farine de blé et une fermentation lente.',
                'prix' => 1000,
                'image_url' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 1,
            ],
            [
                'nom' => 'Croissant au Beurre',
                'description' => 'Viennoiserie feuilletée pur beurre, parfaite pour le petit-déjeuner.',
                'prix' => 1500,
                'image_url' => 'https://i.pinimg.com/1200x/6d/67/36/6d6736cd9acacb860d9c7937ce00e776.jpg',
                'stand_id' => 1,
            ],
            [
                'nom' => 'Pain aux Céréales',
                'description' => 'Un pain riche en graines et en saveurs, idéal pour vos tartines.',
                'prix' => 2000,
                'image_url' => 'https://i.pinimg.com/736x/8a/f7/29/8af7291d97d9c569f23dea73236819d6.jpg',
                'stand_id' => 1,
            ],

            // Produits pour Maria Rossi (Pizza Bella) - stand_id 2
            [
                'nom' => 'Pizza Margherita',
                'description' => 'Tomate, mozzarella di Bufala, basilic frais. La classique italienne.',
                'prix' => 2500,
                'image_url' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 2,
            ],
            [
                'nom' => 'Pizza Quatre Fromages',
                'description' => 'Un mélange onctueux de mozzarella, gorgonzola, parmesan et chèvre.',
                'prix' => 3000,
                'image_url' => 'https://images.unsplash.com/photo-1552539618-7eec9b4d1796?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 2,
            ],
            [
                'nom' => 'Pizza Végétarienne',
                'description' => 'Garniture de poivrons, oignons, champignons et olives fraîches.',
                'prix' => 5000,
                'image_url' => 'https://images.unsplash.com/photo-1595854341625-f33ee10dbf94?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 2,
            ],
            [
                'nom' => 'Calzone Classique',
                'description' => 'Une pizza pliée fourrée à la sauce tomate, mozzarella et jambon.',
                'prix' => 10000,
                'image_url' => 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 2,
            ],
            [
                'nom' => 'Tiramisu Maison',
                'description' => 'Dessert crémeux au café, mascarpone et biscuits savoyards.',
                'prix' => 1500,
                'image_url' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 2,
            ],

            // Produits pour Karim Ben (Le Traiteur) - stand_id 3
            [
                'nom' => 'Couscous Royal',
                'description' => 'Semoule fine, légumes frais, poulet, merguez et agneau.',
                'prix' => 5000,
                'image_url' => 'https://i.pinimg.com/736x/07/67/3e/07673ea509c19211ebf90ecd4c5bf7e7.jpg',
                'stand_id' => 3,
            ],
            [
                'nom' => 'Tajine de Poulet',
                'description' => 'Poulet aux olives et citrons confits, cuit lentement à l\'étouffée.',
                'prix' => 3000,
                'image_url' => 'https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 3,
            ],
            [
                'nom' => 'Salade Marocaine',
                'description' => 'Salade de tomates, concombres, oignons et herbes fraîches.',
                'prix' => 1000,
                'image_url' => 'https://images.unsplash.com/photo-1546793665-c74683f339c1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 3,
            ],

            // Produits pour Sophie Martin (Choco Délices) - stand_id 4
            [
                'nom' => 'Tablette Chocolat Noir',
                'description' => 'Chocolat noir intense à 70% de cacao, pur beurre de cacao.',
                'prix' => 2500,
                'image_url' => 'https://images.unsplash.com/photo-1571115177098-24ec42ed204d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 4,
            ],
            [
                'nom' => 'Truffes au Chocolat',
                'description' => 'Truffes artisanales fondantes, enrobées de cacao en poudre.',
                'prix' => 1000,
                'image_url' => 'https://images.unsplash.com/photo-1493925410384-84f842e616fb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 4,
            ],
            [
                'nom' => 'Bonbons au Caramel Salé',
                'description' => 'Caramels mous à la fleur de sel de Guérande, un délice !',
                'prix' => 1500,
                'image_url' => 'https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 4,
            ],

            // Produits pour Luc Boucher (Boucherie Fine) - stand_id 5
            [
                'nom' => 'Rôti de Bœuf',
                'description' => 'Viande de bœuf tendre et savoureuse, idéale pour le four.',
                'prix' => 10000,
                'image_url' => 'https://i.pinimg.com/736x/5a/ad/46/5aad465a0d7c1b2edfb0c24707ef9b1a.jpg',
                'stand_id' => 5,
            ],
            [
                'nom' => 'Saucisson Sec',
                'description' => 'Saucisson artisanal, séché lentement pour un goût incomparable.',
                'prix' => 2500,
                'image_url' => 'https://i.pinimg.com/736x/c9/dd/92/c9dd925f20d47e57acfd759c3c69e326.jpg',
                'targetContent' => 'stand_id\' => 5,',
                'stand_id' => 5,
            ],
            [
                'nom' => 'Magret de Canard',
                'description' => 'Pièce de canard charnue et délicate, parfaite pour une soirée spéciale.',
                'prix' => 5000,
                'image_url' => 'https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 5,
            ],
            [
                'nom' => 'Steak de Bœuf',
                'description' => 'Un steak de qualité supérieure, idéal pour une cuisson à la poêle.',
                'prix' => 3000,
                'image_url' => 'https://images.unsplash.com/photo-1558030006-450675393462?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 5,
            ],

            // Produits pour Julie Sucre (Pâtisserie Sucrée) - stand_id 6
            [
                'nom' => 'Éclair au Chocolat',
                'description' => 'Pâte à choux garnie d\'une crème pâtissière au chocolat et d\'un glaçage.',
                'prix' => 1000,
                'image_url' => 'https://i.pinimg.com/736x/81/e1/9e/81e19e9417a160c2b914fae54cdbaac5.jpg',
                'stand_id' => 6,
            ],
            [
                'nom' => 'Tarte aux Pommes',
                'description' => 'Tarte traditionnelle avec des pommes fraîches sur une pâte feuilletée.',
                'prix' => 2000,
                'image_url' => 'https://images.unsplash.com/photo-1562440499-64c9a111f713?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 6,
            ],
            [
                'nom' => 'Mille-Feuille',
                'description' => 'Trois couches de pâte feuilletée croustillante alternées de crème pâtissière.',
                'prix' => 1500,
                'image_url' => 'https://i.pinimg.com/1200x/27/a1/96/27a196cfd98812e1eeefddb7e3322a37.jpg',
                'stand_id' => 6,
            ],
            [
                'nom' => 'Macarons Assortis',
                'description' => 'Une boîte de macarons aux saveurs variées et aux couleurs vives.',
                'prix' => 3000,
                'image_url' => 'https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 6,
            ],

            // Produits pour Li Wang (Saveurs d'Asie) - stand_id 7
            [
                'nom' => 'Rouleaux de Printemps',
                'description' => 'Rouleaux de printemps frais aux légumes et vermicelles.',
                'prix' => 2500,
                'image_url' => 'https://images.unsplash.com/photo-1611270632003-7a4d0b8b9f8a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 7,
            ],
            [
                'nom' => 'Poulet au Curry Vert',
                'description' => 'Morceaux de poulet tendres cuits dans une sauce au curry vert.',
                'prix' => 5000,
                'image_url' => 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 7,
            ],

            // Produits pour Emma Green (Vegan Fresh) - stand_id 8
            [
                'nom' => 'Salade de Quinoa',
                'description' => 'Salade fraîche et colorée à base de quinoa, légumes et vinaigrette maison.',
                'prix' => 2000,
                'image_url' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 8,
            ],
            [
                'nom' => 'Burger Végétal',
                'description' => 'Burger gourmand avec un steak végétal, laitue, tomate et une sauce onctueuse.',
                'prix' => 3000,
                'image_url' => 'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 8,
            ],

            // Produits pour Paul Fromage (Fromagerie) - stand_id 9
            [
                'nom' => 'Assortiment de Fromages',
                'description' => 'Plateau de fromages affinés, idéal pour une dégustation.',
                'prix' => 5000,
                'image_url' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 9,
            ],
            [
                'nom' => 'Camembert AOP',
                'description' => 'Camembert de Normandie au lait cru, à la saveur intense.',
                'prix' => 1500,
                'image_url' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 9,
            ],
            [
                'nom' => 'Chèvre Frais aux Herbes',
                'description' => 'Fromage de chèvre frais roulé dans un mélange d\'herbes de Provence.',
                'prix' => 1000,
                'image_url' => 'https://images.unsplash.com/photo-1551818255-e6e10975bc17?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'stand_id' => 9,
            ],
        ];

        foreach ($produits as &$produit) {
            # On retire le paramètre de test s'il existe
            if (isset($produit['targetContent'])) unset($produit['targetContent']);
            $produit['created_at'] = $now;
            $produit['updated_at'] = $now;
        }

        DB::table('produits')->insert($produits);
    }
}
